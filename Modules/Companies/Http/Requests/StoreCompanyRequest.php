<?php
namespace Modules\Companies\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Users\Rules\Phone;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:100', Rule::unique('companies', 'name')],
            'email' => ['required', 'max:100', 'email', Rule::unique('companies', 'email')],
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
