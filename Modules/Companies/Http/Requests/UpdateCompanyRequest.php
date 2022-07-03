<?php
namespace Modules\Companies\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Users\Rules\Phone;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:100', Rule::unique('companies', 'name')->ignore($this->company->id)],
            'email' => ['required', 'max:100', 'email', Rule::unique('companies', 'email')->ignore($this->company->id)],
            'content' => ['required', 'min:4'],
            'online' => ['required', 'boolean'],
            'phone' => ['nullable', 'min:6', new Phone()],
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
