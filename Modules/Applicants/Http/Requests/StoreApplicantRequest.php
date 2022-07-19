<?php
namespace Modules\Applicants\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\Applicants\Enums\Status;
use Modules\Applicants\Rules\ApplicantRule;
use Modules\Users\Rules\Phone;

class StoreApplicantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => [
                'required',
                Rule::exists('users', 'id'),
                new ApplicantRule($this->user_id, $this->job_id)
            ],
            'message' => ['nullable', 'min:4'],
            'job_id' => ['required', Rule::exists('jobs', 'id')],
            'phone' => ['nullable', 'min:6', new Phone()],
            'status' => [new Enum(Status::class)],
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
