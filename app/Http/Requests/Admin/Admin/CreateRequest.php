<?php

namespace App\Http\Requests\Admin\Admin;

use App\Enums\Models\Admin\Role;
use App\Requests\Interfaces\CreateInput;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Auth\AuthManager;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest implements CreateInput
{
    private $authManager;

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
        $user = $this->authManager->guard('admin')->user();
        return $user && $user->role->is(Role::Administrator);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:40'],
            'email' => ['required', 'email', 'max:191', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'max:32'],
            'role' => ['required', new EnumValue(Role::class)]
        ];
    }

    public function userId(): int
    {
        return intval($this->authManager->guard('admin')->user()->id);
    }

    public function validated(): array
    {
        $validated = parent::validated();
        $validated['password'] = bcrypt($validated['password']);
        return $validated;
    }
}
