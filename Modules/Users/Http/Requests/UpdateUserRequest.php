<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Modules\Users\Rules\Phone;

class UpdateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:100'],
            'email' => ['required', 'max:100', 'email', Rule::unique('users')->ignore($this->user->id)],
            'role' => ['required', 'min:1', 'integer'],
            'password' => ['nullable', Password::min(8)->letters()->mixedCase()],
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
