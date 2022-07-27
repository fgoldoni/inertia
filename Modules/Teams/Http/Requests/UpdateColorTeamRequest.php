<?php

namespace Modules\Teams\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Modules\Teams\Enums\ColorType;

class UpdateColorTeamRequest extends FormRequest
{
    public function rules()
    {
        return [
            'color' => [new Enum(ColorType::class)],
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
