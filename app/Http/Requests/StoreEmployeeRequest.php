<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'employee_code' => ['required', 'string', 'unique:employees,employee_code'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:employees,email'],
            'phone' => ['required', 'string'],
            'department' => ['required', 'string'],
            'designation' => ['required', 'string'],
            'salary' => ['required', 'numeric'],
            'joining_date' => ['required', 'date'],
            'status' => ['required', 'boolean'],
        ];
    }
}
