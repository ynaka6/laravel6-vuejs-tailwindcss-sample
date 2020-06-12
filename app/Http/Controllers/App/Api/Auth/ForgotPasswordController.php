<?php

namespace App\Http\Controllers\App\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\Auth\ForgotPasswordRequest;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Response;

class ForgotPasswordController extends Controller
{

    /**
     * controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendResetLinkEmail(ForgotPasswordRequest $request, Responder $responder): JsonResponse
    {
        $response = $this->broker()->sendResetLink($request->validated());
        return $response == Password::RESET_LINK_SENT
                    ? $responder->success()->respond()
                    : $responder->error()->respond(Response::HTTP_UNPROCESSABLE_ENTITY)
        ;
    }

    private function broker()
    {
        return Password::broker();
    }
}
