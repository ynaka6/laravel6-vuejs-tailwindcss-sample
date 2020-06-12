<?php

namespace App\Http\Requests\App\Auth;

use Illuminate\Foundation\Http\FormRequest;

class InitializeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'company.name' => ['required', 'string', 'max:255'],
            'company.postalCode' => ['sometimes', 'nullable', 'string', 'max:8'],
            'company.address' => ['sometimes', 'nullable', 'string', 'max:160'],
            'company.businessCategoryIds' => ['sometimes', 'nullable', 'array'],
            'profile.name' => ['required', 'string', 'max:160'],
            'employee.department' => ['nullable', 'string', 'max:80'],
        ];
    }

    public function attributes(): array
    {
        $keys = array_keys($this->rules());
        return array_combine($keys, array_map(function ($k) {
            return __('db.attributes.' . $k);
        }, $keys));
    }
}
