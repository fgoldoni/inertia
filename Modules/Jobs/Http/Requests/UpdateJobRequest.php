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
            'company_id' => ['required', Rule::exists('companies', 'id')],
            'area' => ['nullable', Rule::exists('categories', 'id')],
            'salary_min' => ['required', 'integer'],
            'salary_max' => ['required', 'integer'],
            'salary_type' => [new Enum(SalaryType::class)],
            'job_type' => ['nullable', Rule::exists('categories', 'id')],
            'job_level' => ['nullable', Rule::exists('categories', 'id')],
            'apply_type' => ['nullable', Rule::exists('categories', 'id')],
            'negotiable' => ['nullable', 'boolean'],
            'address' => ['nullable'],
            'iframe' => ['nullable'],
            'state' => [new Enum(JobState::class)],
            'skills.*' => ['nullable', 'int', Rule::exists('categories', 'id')],
            'benefits.*' => ['nullable', 'int', Rule::exists('categories', 'id')],
            'responsibilities.*' => ['nullable', 'int', Rule::exists('categories', 'id')],
            'gender' => ['nullable', 'max:256'],
            'city_id' => ['required', Rule::exists('world_cities', 'id')],
            'team_id' => ['required', Rule::exists('teams', 'id')],
            'country_id' => ['required', Rule::exists('world_countries', 'id')],
            'avatar_path' => ['nullable', 'max:256'],
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
