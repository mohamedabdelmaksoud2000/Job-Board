<?php

namespace App\Http\Requests;

use App\Enums\JobStatus;
use App\Enums\JobType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'         => ['required','string','max:255'],
            'descrition'    => ['required','string'],
            'company_name'  => ['required','string','max:255'],
            'salary_min'    => ['required','decimal:0,2'],
            'salary_max'    => ['required','decimal:0,2','gta:salary_min'],
            'is_remote'     => ['required','boolean'],
            'job_type'      => ['required','string',Rule::enum(JobType::class)],
            'status'        => ['required','string',Rule::enum(JobStatus::class)],
            'published_at'  => ['required','date'],
            'languages'     => ['required','array'],
            'languages.*'   => ['required','exists:languages,id'],
            'locations'     => ['required','array'],
            'locations.*'   => ['required','exists:locations,id'],
            'categories'    => ['required','array'],
            'categories.*'  => ['required','exists:categories,id'],
            'attributes'    => ['nullable','array'],
            'attributes.*.id'  => ['required_if:attributes','exists:attributes,id'],
            'attributes.*.value'  => ['required_if:attributes'],
        ];
    }
}
