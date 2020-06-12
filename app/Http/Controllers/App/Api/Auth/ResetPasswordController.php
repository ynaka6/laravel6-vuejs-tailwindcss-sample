<?php

namespace App\Http\Controllers\App\Api\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\App\Auth\ResetPasswordRequest;
use App\Transformers\User\Transformer as UserTransformers;
use Carbon\CarbonImmutable;
use Flugg\Responder\Responder;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends Controller
{
    public function reset(ResetPasswordRequest $request, Responder $responder): JsonResponse
    {
        $targetUser = null;
        $response = $this->broker()->reset($request->validated(), function ($user, $password) use (&$targetUser) {
            $user->password = Hash::make($password);
            $user->setRememberToken(Str::random(60));
            if (!$user->email_verified_at) {
                $user->email_verified_at = CarbonImmutable::now();
            }
            $user->save();
            event(new PasswordReset($user));
            $this->guard()->login($user);

            $user->load('profile');
            $user->load('mainEmployee');
            $user->load('mainEmployee.company');
            $user->load('employees');
            $user->load('employees.company');
            
            $targetUser = $user;
        });

        return $response == Password::PASSWORD_RESET
                    ? $responder->success($targetUser, UserTransformers::class)->respond()
                    : $responder->error(__($response))->respond(Response::HTTP_UNPROCESSABLE_ENTITY)
        ;
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
