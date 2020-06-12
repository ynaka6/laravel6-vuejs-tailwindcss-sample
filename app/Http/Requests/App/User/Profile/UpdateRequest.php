<?php

namespace App\Http\Requests\App\User\Profile;

use App\Enums\Models\UserProfile\Gender;
use App\Enums\Models\UserProfile\Status;
use App\Rules\Tel;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Auth\AuthManager;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateRequest extends FormRequest
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
            'profile.name' => ['required', 'string', 'max:160'],
            'profile.nameKana' => ['nullable', 'string', 'max:160'],
            'mainEmployee.tel' => [
                'nullable',
                'string',
                'max:20',
                new Tel()
            ],
            'mainEmployee.department' => ['nullable', 'string', 'max:80'],
            'mainEmployee.position' => ['nullable', 'string', 'max:80'],
            'profile.sites.facebook.url' => ['nullable', 'url'],
            'profile.sites.twitter.url' => ['nullable', 'url'],
            'profile.sites.instagram.url' => ['nullable', 'url'],
            'profile.sites.eight.url' => ['nullable', 'url'],
            'profile.sites.personal.url' => ['nullable', 'url'],
            'profile.gender' => [
                'required',
                new EnumValue(Gender::class, false)
            ],
            'profile.status' => [
                'required',
                new EnumValue(Status::class, false)
            ],
            'profile.detail' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function attributes(): array
    {
        $keys = array_keys($this->rules());
        return array_combine($keys, array_map(function ($k) {
            return __('db.attributes.' . $k);
        }, $keys));
    }

    public function userId(): int
    {
        return intval($this->authManager->guard()->user()->id);
    }

    public function validated(): array
    {
        $validated = parent::validated();
        $profile = [];
        foreach ($validated['profile'] as $key => $value) {
            if ($key === 'gender') {
                $profile['gender'] = Gender::getInstance((int) $value);
            } elseif ($key === 'status') {
                $profile['status'] = Status::getInstance((int) $value);
            } else {
                $profile[Str::snake($key)] = $value;
            }
        }

        return [
            'profile' => $profile,
            'mainEmployee' => $validated['mainEmployee']
        ];
    }
}
