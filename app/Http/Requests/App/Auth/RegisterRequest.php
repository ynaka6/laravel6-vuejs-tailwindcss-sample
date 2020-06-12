<?php

namespace App\Http\Requests\App\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function attributes(): array
    {
        $keys = array_keys($this->rules());
        return array_combine($keys, array_map(function ($k) {
            return __('db.attributes.user.' . $k);
        }, $keys));
    }

    public function validated(): array
    {
        $validated = parent::validated();
        $validated['password'] = bcrypt($validated['password']);
        return $validated;
    }
}
