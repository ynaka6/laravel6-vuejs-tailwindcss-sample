<?php

namespace App\Http\Controllers\Admin\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Auth;

class MyController extends Controller
{
    public function __invoke(JsonResponse $response): JsonResponse
    {
        return $response->setData(Auth::guard('admin')->user());
    }
}
