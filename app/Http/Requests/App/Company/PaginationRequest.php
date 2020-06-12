<?php

namespace App\Http\Requests\App\Company;

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
            $attributes['prefLikeName'] = $attributes['name'];
            unset($attributes['name']);
        }
        return $attributes;
    }
}
