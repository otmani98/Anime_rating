<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
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
        'firstName' => ['required', 'string'],
        'lastName'=> ['required', 'string'],
        'userName' => ['required', 'string', 'unique:users,userName'],
        'email' => ['required', 'string','email', 'unique:users,email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
