<?php

namespace App\Http\Requests\Admin\Admin;

use App\Requests\Interfaces\PaginationInput;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;

class PaginationRequest implements PaginationInput
{
    private $request;

    private $authManager;

    public function __construct(Request $request, AuthManager $authManager)
    {
        $this->request = $request;
        $this->authManager = $authManager;
    }

    public function all(): array
    {
        $attributes = $this->request->all();
        if (array_key_exists('name', $attributes) && strlen($attributes['name'])) {
            $attributes['bothLikeName'] = $attributes['name'];
            unset($attributes['name']);
        }
        if (array_key_exists('email', $attributes) && strlen($attributes['email'])) {
            $attributes['bothLikeEmail'] = $attributes['email'];
            unset($attributes['email']);
        }
        if (array_key_exists('role', $attributes) && is_numeric($attributes['role'])) {
            $attributes['role'] = intval($attributes['role']);
        }
        return $attributes;
    }
}
