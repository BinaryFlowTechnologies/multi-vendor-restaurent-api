<?php

namespace App\Http\Requests\Admin\Acl;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
	$modelId = $this->permissions?->id;

	$uniqueRule = ($this->method() == 'PUT')
		? "unique:permissions,name,{$modelId}"
		: 'unique:permissions,name';

	$rules = [
		'name'        => "required|string|max:255|{$uniqueRule}",
		'description' => 'nullable|string|max:255',
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
		'name.required'      => 'Permission name is required',
		'description.string' => 'Description must be string',
	];
  }
}
