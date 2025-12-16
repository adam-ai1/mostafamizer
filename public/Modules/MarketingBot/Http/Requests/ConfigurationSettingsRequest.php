<?php

namespace Modules\MarketingBot\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigurationSettingsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|string',
            'whatsapp_sid' => 'required_if:type,whatsapp|string',
            'whatsapp_token' => 'required_if:type,whatsapp|string',
            'phone_number' => 'required_if:type,whatsapp|string',
            'telegram_token' => 'required_if:type,telegram|string',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
