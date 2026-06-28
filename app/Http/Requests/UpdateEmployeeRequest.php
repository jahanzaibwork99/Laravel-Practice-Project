<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'employee_code' => [
                'sometimes',
                'string',
                'unique:employees,employee_code,' . $this->route('id'),
            ],

            'name' => [
                'sometimes',
                'string',
            ],

            'email' => [
                'sometimes',
                'email',
                'unique:employees,email,' . $this->route('id'),
            ],

            'phone' => [
                'sometimes',
                'string',
            ],

            'department' => [
                'sometimes',
                'string',
            ],

            'designation' => [
                'sometimes',
                'string',
            ],

            'salary' => [
                'sometimes',
                'numeric',
            ],

            'joining_date' => [
                'sometimes',
                'date',
            ],

            'status' => [
                'sometimes',
                'boolean',
            ],
        ];
    }
}