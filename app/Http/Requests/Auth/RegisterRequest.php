<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'full_name' => 'required|string|max:200',
            'user_name' => 'required|string|max:50',
            'mail' => 'required|string|email|max:50|unique:accounts',
            'password' => 'required|string|min:8',
            // 'phone' => 'required|string|max:20', 
            'job_created_at' => 'required|date',
            'job_position_id' => 'required|integer',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'The name field is required',
            'user_name.required' => 'The name field is required',
            'mail.required' => 'The email field is required',
            'mail.email' => 'Please enter a valid email address',
            'mail.unique' => 'This email is already registered',
            'password.required' => 'The password field is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password confirmation does not match',
            'phone.required' => 'The phone field is required', 
            'job_position_id.required' => 'The job_position field is required',
            'job_created_at.required' => 'The birtday field is required',
        ];
    }
}