<?php

namespace App\Http\Requests\App\Auth;

use Illuminate\Auth\AuthManager;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function id(): int
    {
        return intval($this->authManager->guard()->user()->id);
    }

    public function validated()
    {
        $validated = parent::validated();
        $validated['password'] = bcrypt($validated['password']);
        return $validated;
    }
}
