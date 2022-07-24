<?php
namespace Modules\Applicants\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Users\Rules\Phone;
use Modules\Users\Rules\RealEmail;

class ApiStoreApplicantStatusRequest extends FormRequest
{
    public function rules()
    {
        return [
            'message' => ['required', 'min:4'],
            'email' => ['required', 'email', new RealEmail()],
            'job_id' => ['required', Rule::exists('jobs', 'id')],
            'phone' => ['required', 'min:6', new Phone()],
            'resumes' => ['required', 'array'],
            'resumes.*' => ['required', 'integer', Rule::exists('attachments', 'id')],
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
