<?php

namespace App\Http\Controllers\App\Api;

use App\Enums\Models\UserProfile\Status;
use App\Events\App\ViewedUserDetail;
use App\Http\Controllers\Controller;
use App\Models\Interfaces\ShowModel;
use App\Models\User;
use App\UseCases\ShowUseCase;
use App\Transformers\User\RelationshipTransformer as UserTransformer;
use Auth;
use Flugg\Responder\Responder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function (Request $request, $next) {
            app()->bind(ShowModel::class, User::class);
            return $next($request);
        })->only('show');
    }

    public function show(int $userId, ShowUseCase $usecase, Responder $responder): JsonResponse
    {
        $profileStatus = Status::Open();
        $user = $usecase(compact('userId', 'profileStatus'));
        if (Auth::check()) {
            event(new ViewedUserDetail($user, Auth::user()));
        }
        return $responder
            ->success($user, UserTransformer::class)
            ->respond()
        ;
    }
}
