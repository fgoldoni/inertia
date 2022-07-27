<?php

namespace Modules\Attachments\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAvatarRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'file' => ['required', 'mimes:jpeg,jpg,png,gif', 'max:10000'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
