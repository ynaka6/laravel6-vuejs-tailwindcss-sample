<?php

namespace App\Http\Controllers\App\Api\Auth;

use App\Models\Interfaces\UpdateModel;
use App\Models\User;
use App\Http\Requests\App\Auth\ResetEmailRequest;
use App\Http\Controllers\Controller;
use App\UseCases\App\ResetEmailUseCase;
use Flugg\Responder\Responder;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResetEmailController extends Controller
{
    private $user;

    /**
     * Create a new controller instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('signed')->only('accept');
        $this->middleware('throttle:6,1')->only('accept');
    }

    public function reset(ResetEmailRequest $request, ResetEmailUseCase $usecase, Responder $responder): JsonResponse
    {
        $usecase($request->userId(), $request->validated());
        return $responder->success()->respond();
    }

    public function accept(Request $request, Responder $responder): JsonResponse
    {
        $userResetEmail = $request->user()->findUserResetEmail($request->id);
        if (!hash_equals((string) $request->id, (string) $userResetEmail->id)) {
            throw new AuthorizationException;
        }

        if (!hash_equals((string) $request->hash, sha1($userResetEmail->email))) {
            throw new AuthorizationException;
        }

        $user = $userResetEmail->user;
        $user->email = $userResetEmail->email;
        if (!$user->email_verified_at) {
            $user->email_verified_at = CarbonImmutable::now();
        }
        $user->save();
        $user->load('profile');
        $user->load('mainEmployee');
        $user->load('mainEmployee.company');
        $user->load('employees');
        $user->load('employees.company');
        

        return $responder
            ->success($user)
            ->respond()
        ;
    }
}
