<?php

namespace Modules\MarketingBot\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckValidFile;

class CampaignStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'channel' => 'required',
            'title' => 'required',
            'content' => 'required_if:channel,telegram',
            'image'  => ['nullable', new CheckValidFile(getFileExtensions(3))],
            'end_date' => 'required|date',
            'chat_provider' => 'required_if:ai_reply,on',
            'chat_model' => 'required_if:ai_reply,on',
            'embedding_provider' => 'required_if:ai_reply,on',
            'embedding_model' => 'required_if:ai_reply,on',
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
