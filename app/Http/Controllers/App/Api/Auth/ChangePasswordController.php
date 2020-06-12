<?php

namespace App\Http\Controllers\App\Api\Auth;

use App\Events\App\UpdatedPassword;
use App\Models\Interfaces\UpdateModel;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\App\Auth\ChangePasswordRequest;
use App\UseCases\UpdateUseCase;
use Auth;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware(function (Request $request, $next) {
            app()->bind(UpdateModel::class, User::class);
            return $next($request);
        });
    }

    public function __invoke(ChangePasswordRequest $request, UpdateUseCase $usecase, Responder $responder): JsonResponse
    {
        $usecase($request->id(), $request->validated());
        event(new UpdatedPassword(Auth::user()));
        return $responder
            ->success()
            ->respond()
        ;
    }
}
