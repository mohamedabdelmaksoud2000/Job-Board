<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocationRequest extends FormRequest
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
            'city'     => ['required', 'string','unique:locations,city,'.$this->location, 'max:255'],
            'state'    => ['required', 'string', 'max:255'],
            'country'  => ['required', 'string', 'max:255'],
        ];
    }
}
