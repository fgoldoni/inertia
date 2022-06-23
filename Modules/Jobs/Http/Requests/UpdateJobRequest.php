<?php

namespace Modules\Jobs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateJobRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:256'],
            'avatar_path' => ['required', 'max:256'],
            'files.*' => ['nullable', 'max:2048',
                Rule::exists('attachments', 'id')
                ->where(function ($query) {
                    //$query->where('user_id', request()->user()->id);
                })
            ],
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
