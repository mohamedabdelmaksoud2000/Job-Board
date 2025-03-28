<?php

namespace App\Http\Requests;

use App\Enums\JobStatus;
use App\Enums\JobType;
use App\Rules\AttributeValueRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateJobRequest extends FormRequest
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
            'description'    => ['required','string'],
            'company_name'  => ['required','string','max:255'],
            'salary_min'    => ['required','decimal:0,2'],
            'salary_max'    => ['required','decimal:0,2'],
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
            'attributes.*.attribute_id'  => ['required_with:attributes','exists:attributes,id'],
            'attributes.*.value'  => ['required_with:attributes',new AttributeValueRule()],
        ];
    }
}
