<?php

namespace Modules\MarketingBot\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class SegmentUpdateRequest extends FormRequest
{
    public function rules()
    {
        $segmentId = $this->route('id');

        return [
            'segment_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('segments', 'name')
                    ->where(fn($q) => $q->where('user_id', Auth::id()))
                    ->ignore($segmentId),
            ],
        ];
    }

    public function authorize()
    {
        return Auth::check();
    }
}

