<?php

namespace Modules\Teams\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeamRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:100'],
            'display_name' => ['required', 'max:100'],
            'subdomain' => ['required', 'max:100', 'alpha_dash', Rule::unique('teams')->ignore($this->team->id)],
            'industry' => ['required', Rule::exists('categories', 'id')],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
