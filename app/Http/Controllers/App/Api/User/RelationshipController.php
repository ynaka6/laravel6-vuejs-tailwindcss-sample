<?php

declare(strict_types=1);

namespace App\Http\Controllers\App\Api\User;

use App\Events\App\FollowedUser;
use App\Events\App\UnfollowedUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\UseCases\App\FollowUserUseCase;
use App\UseCases\App\UnFollowUserUseCase;
use Auth;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;


class RelationshipController extends Controller
{
    public function store(int $userId, FollowUserUseCase $usecase, Responder $responder): JsonResponse
    {
        [$user, $count] = $usecase(Auth::id(), $userId);
        event(new FollowedUser($user, Auth::user()));
        return $responder
            ->success([ 'count' => $count ])
            ->respond()
        ;
    }

    public function destroy(int $userId, UnFollowUserUseCase $usecase, Responder $responder): JsonResponse
    {
        [$user, $count] = $usecase(Auth::id(), $userId);
        event(new UnfollowedUser($user, Auth::user()));
        return $responder
            ->success([ 'count' => $count ])
            ->respond()
        ;
    }
}
