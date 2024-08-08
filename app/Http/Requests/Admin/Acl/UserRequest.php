<?php

namespace App\Http\Requests\Admin\Acl;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules() : array
    {
        $modelId = $this->user ?: null;

        $uniqueRule = ($this->method() === 'PUT' && $modelId !== null)
            ? 'unique:users,email,' . $modelId
            : 'unique:users,email';

        $rules = [
            'name'     => 'required|string|max:255',
            'email'    => "required|string|email|max:255|{$uniqueRule}",
            'roles'    => 'nullable|array',
            'roles.*'  => 'exists:roles,id'
        ];

        if ($this->method() === 'POST') {
            $rules['password'] = 'required|string|min:8';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */

    public function messages() : array
    {
        return [
            'name.required'     => 'Name is required',
            'name.string'       => 'Name must be a string',
            'name.max'          => 'Name must not be greater than 255 characters',
            'email.required'    => 'Email is required',
            'email.email'       => 'Email must be a valid email address',
            'password.required' => 'Password is required',
            'password.min'      => 'Password must be at least 8 characters',
            'roles.array'       => 'Roles must be an array',
            'roles.*.exists'    => 'Role does not exist'
        ];
    }
}
