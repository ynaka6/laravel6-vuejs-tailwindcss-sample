<?php

namespace App\Http\Requests\App\Auth;

use Illuminate\Auth\AuthManager;
use Illuminate\Foundation\Http\FormRequest;

class ResetEmailRequest extends FormRequest
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
            'currentEmail' => [
                'required',
                'string',
                'email',
                'max:255',
                'exists:users,email'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:user_reset_emails,email,' . $this->authManager->guard()->user()->id . ',user_id'
            ],
        ];
    }

    public function userId(): int
    {
        return intval($this->authManager->guard()->user()->id);
    }
}
