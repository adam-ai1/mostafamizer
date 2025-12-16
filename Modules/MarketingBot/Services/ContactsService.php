<?php

namespace Modules\MarketingBot\Services;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\MarketingBot\Entities\Contact;
use Modules\MarketingBot\Entities\Segment;
use Modules\MarketingBot\Http\Requests\ContactStoreRequest;

/**
 * Service class for managing contacts in the MarketingBot module.
 * 
 * Handles CRUD operations for contacts including creation, retrieval, update, and deletion.
 * All operations are scoped to the authenticated user.
 * 
 * @package Modules\MarketingBot\Services
 */
class ContactsService
{
    
    /**
     * Get the base query for contacts scoped to the authenticated user.
     *
     * Returns a Contact query builder pre-filtered to only include contacts
     * for the currently authenticated user with whatsapp channel and
     * eager-loaded metas relationship.
     *
     * @return \Illuminate\Database\Eloquent\Builder<Contact>
     */
    public function model()
    {
        return Contact::with('metas')->where('channel', 'whatsapp')->where('user_id', Auth::id());
    }

    /**
     * Get all contacts for the authenticated user.
     *
     * Returns a query builder that can be further filtered and paginated.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getAllContacts()
    {
        return $this->model();
    }

    /**
     * Store a new contact for the authenticated user.
     * 
     * Creates a new contact with the provided information. Validates that the phone
     * number is unique for the user before creating the contact.
     * 
     * @param ContactStoreRequest $request The validated request containing contact data
     * @return Contact The created contact instance
     * @throws Exception If phone number already exists or save operation fails
     */
    public function contactStore(ContactStoreRequest $request): Contact
    {
        DB::beginTransaction();

        try {
            $fullPhoneNumber = $request->phone;
            $countryIsoCode = $request->country_code;

            $existingContact = $this->model()
                ->where('phone', $fullPhoneNumber)
                ->first();

            if ($existingContact) {
                DB::rollBack();
                throw new Exception(__('Phone number already exists in your contacts.'), Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $contact = new Contact;
            $contact->name = $request->name;
            $contact->phone = $fullPhoneNumber;
            $contact->country_code = $countryIsoCode;
            $contact->user_id = Auth::id();
            $contact->channel = 'whatsapp';
            $contact->status = 'active';
            $contact->segment_ids = $request->filled('segment_ids') ? $request->segment_ids : null;

            if (!$contact->save()) {
                throw new Exception('Failed to save contact');
            }

            DB::commit();

            return $contact;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update an existing contact for the authenticated user.
     * 
     * Updates the contact with the given ID. Validates that the phone number
     * is unique (excluding the current contact) before updating.
     * 
     * @param ContactStoreRequest $request The validated request containing updated contact data
     * @param int|string $id The ID of the contact to update
     * @return Contact The updated contact instance
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If contact is not found
     * @throws Exception If phone number already exists or update operation fails
     */
    public function contactUpdate(ContactStoreRequest $request, $id): Contact
    {
        DB::beginTransaction();

        try {
            $fullPhoneNumber = $request->phone;
            $countryIsoCode = $request->country_code;

            $existingContact = $this->model()
                ->where('phone', $fullPhoneNumber)
                ->where('id', '!=', $id) // Exclude current contact during update
                ->first();
            
            if ($existingContact) {
                DB::rollBack();
                throw new Exception(__('Phone number already exists in your contacts.'), Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $contact = $this->showContact($id);

            $contact->name = $request->name;
            $contact->phone = $fullPhoneNumber;
            $contact->country_code = $countryIsoCode;
            $contact->segment_ids = $request->filled('segment_ids') ? $request->segment_ids : null;

            if (!$contact->save()) {
                throw new Exception('Failed to update contact');
            }

            DB::commit();

            return $contact;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Get a single contact by ID for the authenticated user.
     *
     * @param int|string $id The ID of the contact to retrieve
     * @return Contact The contact instance
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If contact not found
     */
    public function showContact($id): Contact
    {
        return $this->model()->whereKey($id)->firstOrFail();
    }

    /**
     * Delete a contact for the authenticated user.
     *
     * @param int|string $id The ID of the contact to delete
     * @return void
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If contact not found
     * @throws Exception If contact deletion fails
     */
    public function deleteContact($id): void
    {
        DB::beginTransaction();

        try {
            $contact = $this->model()->whereKey($id)->firstOrFail();
            $contact->delete();

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}