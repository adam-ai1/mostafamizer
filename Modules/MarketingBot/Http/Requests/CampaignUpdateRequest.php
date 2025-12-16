<?php

namespace Modules\MarketingBot\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'ends_at' => 'nullable|date',
            'schedule' => 'nullable|in:on',
            'schedule_date' => 'required_if:schedule,on|nullable|date',
            'schedule_time' => 'required_if:schedule,on|nullable|date_format:H:i',
            'ai_reply' => 'nullable|in:on',
            'chat_provider' => 'required_if:ai_reply,on|nullable|string',
            'chat_model' => 'required_if:ai_reply,on|nullable|string',
            'embedding_provider' => 'required_if:ai_reply,on|nullable|string',
            'embedding_model' => 'required_if:ai_reply,on|nullable|string',
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

