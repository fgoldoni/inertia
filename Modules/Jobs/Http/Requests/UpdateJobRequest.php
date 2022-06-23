<?php

namespace Modules\Jobs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\Jobs\Enums\JobState;
use Modules\Jobs\Enums\SalaryType;

class UpdateJobRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:256'],
            'content' => ['required', 'min:4'],
            'company' => ['required', Rule::exists('companies', 'id')],
            'area' => ['required', Rule::exists('categories', 'id')],
            'industry' => ['required', Rule::exists('categories', 'id')],
            'salary_min' => ['required', 'integer'],
            'salary_max' => ['required', 'integer'],
            'salary_type' => [new Enum(SalaryType::class)],
            'job_type' => ['required', Rule::exists('categories', 'id')],
            'negotiable' => ['required', 'boolean'],
            'avatar_path' => ['nullable', 'max:256', Rule::exists('categories', 'id')],
            'files.*' => ['nullable', 'max:2048',
                Rule::exists('attachments', 'id')
                ->where(function ($query) {
                    //$query->where('user_id', request()->user()->id);
                })
            ],
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
