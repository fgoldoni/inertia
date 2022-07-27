<?php

namespace Modules\Teams\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTeamRequest extends FormRequest
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
            'display_name' => ['required', 'max:100'],
            'subdomain' => ['required', 'max:100', 'alpha_dash', Rule::unique('teams', 'subdomain')],
            'industry' => ['required', Rule::exists('categories', 'id')],
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
