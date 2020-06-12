<?php

namespace App\Http\Controllers\App\Api;

use App\Http\Controllers\Controller;
use App\Transformers\User\Transformer as UserTransformer;
use App\UseCases\App\GetUserUseCase;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;
use Auth;

class MyController extends Controller
{
    public function __invoke(GetUserUseCase $usecase, Responder $responder): JsonResponse
    {
        return $responder
            ->success(Auth::check() ? $usecase(Auth::guard()->id()) : null, UserTransformer::class)
            ->respond()
        ;
    }
}
