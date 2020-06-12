<?php

namespace App\Http\Controllers\App\Api\User;

use App\Events\App\UpdatedProfile;
use App\Http\Controllers\Controller;
use App\Http\Requests\App\User\Profile\UpdateRequest;
use App\UseCases\App\UpdateUserProfileUseCase;
use App\Transformers\User\Transformer as UserTransformers;
use Flugg\Responder\Responder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    public function update(UpdateRequest $request, UpdateUserProfileUseCase $usecase, Responder $responder): JsonResponse
    {
        $user = $usecase($request->userId(), $request->validated());
        event(new UpdatedProfile($user));
        return $responder
            ->success($user, UserTransformers::class)
            ->respond()
        ;
    }
}
