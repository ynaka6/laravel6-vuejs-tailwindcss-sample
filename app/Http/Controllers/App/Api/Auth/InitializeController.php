<?php

namespace App\Http\Controllers\App\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\Auth\InitializeRequest;
use App\Transformers\User\Transformer as UserTransformers;
use App\UseCases\App\InitializeUserUseCase;
use Flugg\Responder\Responder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Auth;

class InitializeController extends Controller
{
    public function register(InitializeRequest $request, InitializeUserUseCase $usecase, Responder $responder): JsonResponse
    {
        return $responder
            ->success($usecase(Auth::guard()->id(), $request->validated()), UserTransformers::class)
            ->respond()
        ;
    }
}
