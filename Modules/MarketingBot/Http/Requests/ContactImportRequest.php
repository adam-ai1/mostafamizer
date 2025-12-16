<?php

namespace Modules\MarketingBot\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Maatwebsite\Excel\HeadingRowImport;

class ContactImportRequest extends FormRequest
{
    public function rules()
    {
        return [
            'file' => [
                'required',
                'mimes:xlsx,csv,xls',
                function ($attribute, $value, $fail) {
                    try {
                        // Read only the headers from the Excel file
                        $headings = (new HeadingRowImport)->toArray($value);

                        if (empty($headings) || empty($headings[0])) {
                            $fail('The file appears to be empty or invalid.');
                            return;
                        }

                        if (!isset($headings[0]) || !is_array($headings[0]) || empty($headings[0])) {
                            $fail('Unable to read headers from the file.');
                            return;
                        }
                        
                        $actualHeaders = reset($headings[0]);
                        if (!is_array($actualHeaders)) {
                            $fail('Invalid header format in the file.');
                            return;
                        }

                        // Normalize the actual headers (same normalization as in your import)
                        $normalizedActualHeaders = array_map(function ($header) {
                            return strtolower(preg_replace('/[^a-z0-9_]/', '_', (string) $header));
                        }, $actualHeaders);

                        // Define required headers
                        $requiredHeaders = ['name', 'phone'];
                        $optionalHeaders = ['country_code', 'country', 'channel', 'status'];

                        // Check if required headers are present
                        $missingHeaders = array_diff($requiredHeaders, $normalizedActualHeaders);

                        if (!empty($missingHeaders)) {
                            $fail('Invalid file format. Missing required columns');
                            return;
                        }

                        // Optional: Check for any completely unexpected headers
                        $allowedHeaders = array_merge($requiredHeaders, $optionalHeaders);
                        $unexpectedHeaders = array_diff($normalizedActualHeaders, $allowedHeaders);

                        if (!empty($unexpectedHeaders)) {
                            \Log::warning('Unexpected headers in import file', [
                                'unexpected_headers' => $unexpectedHeaders,
                                'actual_headers' => $actualHeaders
                            ]);
                        }

                    } catch (\Exception $e) {

                        \Log::error('Failed to read import file headers', [
                            'exception' => $e->getMessage(),
                            'file' => $value->getClientOriginalName()
                        ]);

                        $fail('Unable to read the uploaded file. Please ensure it is a valid Excel or CSV file.');
                    }
                }
            ],
        ];
    }

    public function authorize()
    {
        return true;
    }
}