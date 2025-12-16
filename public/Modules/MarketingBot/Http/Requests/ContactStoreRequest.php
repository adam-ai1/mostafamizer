<?php

namespace Modules\MarketingBot\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;


class ContactStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'country_code' =>'required|string|max:5',
            'segment_ids' => 'nullable|array',
            'segment_ids.*' => 'integer|exists:segments,id,user_id,' . Auth::id(),
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Contact name is required.'),
            'name.string' => __('Contact name must be a valid text.'),
            'name.max' => __('Contact name cannot exceed 255 characters.'),

            'phone.required' => __('Phone number is required.'),
            'phone.string' => __('Phone number must be a valid text.'),
            'phone.max' => __('Phone number cannot exceed 20 characters.'),

            'country_code.required' => __('Country code is required.'),
            'country_code.string' => __('Country code must be a valid text.'),
            'country_code.max' => __('Country code cannot exceed 5 characters.'),

            'segment_ids.array' => __('Segments must be provided as an array.'),

            'segment_ids.*.integer' => __('Each segment ID must be a valid number.'),
            'segment_ids.*.exists' => __('One or more selected segments are invalid or do not belong to you.'),
        ];
    }

    public function authorize()
    {
        return true;
    }
}
