<?php

namespace Modules\Comments\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiViewCommentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'model' => ['required', 'string', 'min:4'],
            'modelId' => ['required', 'int'],
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
