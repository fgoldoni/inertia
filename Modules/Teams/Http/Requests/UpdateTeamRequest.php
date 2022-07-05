<?php

namespace Modules\Teams\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Modules\Users\Rules\Phone;

class UpdateTeamRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:100'],
            'display_name' => ['required', 'max:100'],
            'subdomain' => ['required', 'max:100', 'alpha', Rule::unique('teams')->ignore($this->team->id)],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
