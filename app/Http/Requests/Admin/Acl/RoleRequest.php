<?php

namespace App\Http\Requests\Admin\Acl;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize (): bool
  {
	return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules (): array
  {
	$modelId = $this->role ?: null;

	$uniqueRule = ($this->method() == 'PUT' && $modelId !== null)
		? "unique:roles,name,{$modelId}"
		: 'unique:roles,name';

	$rules = [
		'name'        => "required|string|max:255|{$uniqueRule}",
		'description' => 'nullable|string|max:255',
		'permissions' => 'nullable|array',
	];

	return $rules;
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */

  public function messages (): array
  {
	return [
		'name.required'      => 'Role name is required',
		'description.string' => 'Description must be string',
		'permissions.array'  => 'Permissions must be an array',
	];
  }
}
