<?php
namespace Modules\Attachments\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttachmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'disk' => ['nullable', 'string', 'in:uploads,avatars'],
            'file' => ['required', 'mimes:jpeg,jpg,png,gif', 'max:10000']
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
