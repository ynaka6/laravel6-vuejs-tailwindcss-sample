<?php

namespace App\Http\Requests\Admin\Admin;

use App\Enums\Models\Admin\Role;
use App\Requests\Interfaces\UpdateInput;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Auth\AuthManager;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest implements UpdateInput
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
            'email' => ['required', 'email', 'max:191', 'unique:admins,email,' . $this->route('id') . ',id'],
            'password' => ['sometimes', 'nullable', 'string', 'min:8', 'max:32'],
            'role' => ['required', new EnumValue(Role::class)]
        ];
    }

    public function id(): int
    {
        return intval($this->route('id'));
    }

    public function userId(): int
    {
        return intval($this->authManager->guard('admin')->user()->id);
    }

    public function validated(): array
    {
        $validated = parent::validated();
        if ($validated['password']) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }
        return $validated;
    }
}
