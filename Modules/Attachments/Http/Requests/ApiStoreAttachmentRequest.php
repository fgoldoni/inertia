<?php
namespace Modules\Attachments\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiStoreAttachmentRequest extends FormRequest
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
            'type' => ['nullable', 'string', 'in:resumes,avatars'],
            'attachment' => 'required|file|mimes:doc,docx,pdf|max:10000'
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
