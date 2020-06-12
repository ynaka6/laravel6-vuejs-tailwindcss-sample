<?php

namespace App\Http\Requests\Admin\Admin;

use App\Requests\Interfaces\ShowInput;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;

class ShowRequest implements ShowInput
{
    private $request;

    private $authManager;

    public function __construct(Request $request, AuthManager $authManager)
    {
        $this->request = $request;
        $this->authManager = $authManager;
    }

    public function id(): int
    {
        return intval($this->request->route('id'));
    }

    public function userId(): int
    {
        return intval($this->authManager->guard('admin')->user()->id);
    }
}
