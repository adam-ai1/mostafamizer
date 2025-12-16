<?php

namespace App\Imports;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Modules\MarketingBot\Entities\Contact;

class ContactsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
//    use SkipsFailures;

    protected int $importedCount = 0;
    protected int $skippedCount = 0;
    protected int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function model(array $row)
    {
        // Normalize column keys (handle variations like "country_code", "country_code", etc.)
        $normalizedRow = [];
        foreach ($row as $key => $value) {
            // Normalize key: lowercase, replace spaces/special chars with underscore
            $normalizedKey = strtolower(preg_replace('/[^a-z0-9_]/', '_', $key));
            $normalizedRow[$normalizedKey] = $value;
        }

        // Extract name
        $name = trim($normalizedRow['name'] ?? '');
        if (empty($name)) {
            $this->skippedCount++;
            return null; // Skip rows without name
        }

        // Clean up phone number by removing any non-digit characters
        $phone = preg_replace('/[^0-9]/', '', $normalizedRow['phone'] ?? '');
        if (empty($phone)) {
            $this->skippedCount++;
            return null; // Skip rows without phone
        }

        // Extract country code
        $countryCode = null;
        foreach (['country_code', 'country'] as $key) {
            if (isset($normalizedRow[$key]) && !empty($normalizedRow[$key])) {
                $countryCode = strtoupper(trim($normalizedRow[$key]));
                break;
            }
        }
        $countryCode = $countryCode ?: 'US'; // Default to US

        // Extract channel (check both channel and status columns, as status might contain channel info)
        $channel = null;
        $validChannels = ['whatsapp', 'telegram', 'sms', 'email'];

        // First check the channel column
        if (isset($normalizedRow['channel']) && !empty($normalizedRow['channel'])) {
            $channelValue = strtolower(trim($normalizedRow['channel']));
            foreach ($validChannels as $validChannel) {
                if (strpos($channelValue, $validChannel) !== false) {
                    $channel = $validChannel;
                    break;
                }
            }
        }

        // If channel not found, check status column (might contain "whatsapp active")
        if (!$channel && isset($normalizedRow['status']) && !empty($normalizedRow['status'])) {
            $statusValue = strtolower(trim($normalizedRow['status']));
            foreach ($validChannels as $validChannel) {
                if (strpos($statusValue, $validChannel) !== false) {
                    $channel = $validChannel;
                    break;
                }
            }
        }

        $channel = $channel ?: 'whatsapp'; // Default to whatsapp

        // Extract status (handle cases where status might contain "whatsapp active" or just "active")
        $status = 'active'; // Default
        $statusValue = strtolower(trim($normalizedRow['status'] ?? ''));

        // Also check channel column if status is empty
        if (empty($statusValue) && isset($normalizedRow['channel']) && !empty($normalizedRow['channel'])) {
            $statusValue = strtolower(trim($normalizedRow['channel']));
        }

        if (!empty($statusValue)) {
            // Remove channel names to extract just status
            foreach ($validChannels as $validChannel) {
                $statusValue = str_replace($validChannel, '', $statusValue);
            }
            $statusValue = trim($statusValue);

            // Check if it contains "active" or "inactive"
            if (strpos($statusValue, 'active') !== false && strpos($statusValue, 'inactive') === false) {
                $status = 'active';
            } elseif (strpos($statusValue, 'inactive') !== false) {
                $status = 'inactive';
            } elseif (in_array($statusValue, ['active', 'inactive'])) {
                $status = $statusValue;
            }
        }

        // Check for duplicate phone number for this user
        $existingContact = Contact::with('metas')->where('user_id', $this->userId)
            ->where('phone', $phone)
            ->first();

        if ($existingContact) {
            // Skip duplicate instead of failing
            $this->skippedCount++;
            return null;
        }
        $this->importedCount++;
        return new Contact([
            'user_id' => $this->userId,
            'name' => $name,
            'phone' => $phone,
            'country_code' => $countryCode,
            'channel' => $channel,
            'status' => $status,
        ]);
    }

    /**
     * Get the number of successfully imported contacts
     */
    public function getImportedCount()
    {
        return $this->importedCount;
    }

    /**
     * Get the number of skipped contacts
     */
    public function getSkippedCount()
    {
        return $this->skippedCount;
    }

    /**
     * Validation rules for each row.
     */
    public function rules(): array
    {
        return [
            '*.name' => 'required|string|max:255',
            '*.phone' => 'required|max:191',
            '*.country_code' => 'nullable|string|max:10',
            '*.channel' => 'nullable|string|max:191',
            '*.status' => 'nullable|string|max:191',
        ];
    }

    /**
     * Custom validation messages.
     */
    public function customValidationMessages()
    {
        return [
            '*.name.required' => 'Name is required',
            '*.phone.required' => 'Phone number is required',
        ];
    }

    /**
     * Handle import failures gracefully
     */
    public function onFailure(Failure ...$failures)
    {
        // Log failures but don't stop the import
        foreach ($failures as $failure) {
            \Log::warning('Contact import failure', [
                'row' => $failure->row(),
                'attribute' => $failure->attribute(),
                'errors' => $failure->errors(),
                'values' => $failure->values(),
            ]);
        }
    }
}
