<?php

namespace Modules\Dashboard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDashboardUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'layouts.*.user_id' => ['required', 'integer', Rule::exists('dashboard_user')->where(function ($query) {
                    return $query->where('user_id', auth()->user()->id);
                })
            ],
            'layouts.*.x' => ['required', 'integer'],
            'layouts.*.y' => ['required', 'integer'],
            'layouts.*.w' => ['nullable', 'integer'],
            'layouts.*.h' => ['nullable', 'integer'],
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
