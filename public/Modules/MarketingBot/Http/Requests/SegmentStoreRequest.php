<?php

namespace Modules\MarketingBot\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class SegmentStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'segment_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('segments', 'name')->where(fn($q) =>
                    $q->where('user_id', Auth::id())
                ),
            ],
        ];
    }

    public function authorize()
    {
        return Auth::check();
    }
}
