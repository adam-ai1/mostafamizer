<?php

namespace Modules\MarketingBot\Services;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\MarketingBot\Entities\Segment;
use Modules\MarketingBot\Http\Requests\SegmentStoreRequest;
use Modules\MarketingBot\Http\Requests\SegmentUpdateRequest;

/**
 * Service class for managing segments in the MarketingBot module.
 * 
 * Handles CRUD operations for segments including creation, retrieval, update, and deletion.
 * All operations are scoped to the authenticated user.
 * 
 * @package Modules\MarketingBot\Services
 */
class SegmentService
{

    /**
     * Get the base query builder for segments.
     *
     * Returns segments with their metas for the authenticated user,
     * filtered by WhatsApp channel.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function model()
    {
        return Segment::with('metas')->where('user_id', auth()->id())
            ->whereHas('metas', function($query) { 
                $query->where('key', 'channel')->where('value', 'whatsapp'); 
            });
    }
    
    /**
     * Get all segments for the authenticated user.
     *
     * Returns a query builder instance for segments belonging to the current user,
     * including their associated metadata. Uses the model() method as base query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function allSegments()
    {
        return $this->model();
    }
    
    /**
     * Store a new segment for the authenticated user.
     * 
     * Creates a new segment with the provided name. Validates that the segment
     * name is unique for the user before creating the segment.
     * 
     * @param SegmentStoreRequest $request The validated request containing segment data
     * @return Segment The created segment instance
     * @throws Exception If segment name already exists or save operation fails
     */
    public function saveSegment(SegmentStoreRequest $request): Segment
    {
        DB::beginTransaction();

        try {
            $existSegment = $this->model()
                    ->where('name', $request->segment_name)
                    ->first();
            
            if ($existSegment) {
                DB::rollBack();
                throw new Exception(__('Segment name already exists.'), Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $segment = new Segment();
            $segment->name = $request->segment_name;
            $segment->user_id = Auth::id();
            $segment->channel = 'whatsapp';

            if (! $segment->save()) {
                throw new Exception('Failed to save segment');
            }

            DB::commit();

            return $segment;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update an existing segment for the authenticated user.
     * 
     * Updates the segment name if it belongs to the authenticated user.
     * Validates that the segment name is unique for the user before updating.
     * 
     * @param SegmentUpdateRequest $request The validated request containing segment data
     * @param int|string $id The ID of the segment to update
     * @return Segment The updated segment instance
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If segment not found
     * @throws Exception If segment update operation fails
     */
    public function updateSegment(SegmentUpdateRequest $request, $id): Segment
    {
        DB::beginTransaction();

        try {
            $segment = $this->model()->whereKey($id)->firstOrFail();

            // Check for duplicate name, excluding current segment
            $existSegment = $this->model()
                ->where('name', $request->segment_name)
                ->where('id', '!=', $id)
                ->first();
            
            if ($existSegment) {
                DB::rollBack();
                throw new Exception(__('Segment name already exists.'), Response::HTTP_UNPROCESSABLE_ENTITY);
            }


            $segment->name = $request->segment_name;
            $segment->update();

            DB::commit();

            return $segment;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete a segment for the authenticated user.
     * 
     * Deletes the segment if it belongs to the authenticated user.
     * 
     * @param int|string $id The ID of the segment to delete
     * @return void
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If segment not found
     * @throws Exception If segment deletion fails
     */
    public function deleteSegment($id): void
    {
        DB::beginTransaction();

        try {
            $segment = $this->model()->whereKey($id)->firstOrFail();
            $segment->delete();

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}