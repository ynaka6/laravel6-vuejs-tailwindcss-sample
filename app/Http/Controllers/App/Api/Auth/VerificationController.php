<?php

declare(strict_types=1);

namespace App\Http\Controllers\App\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Transformers\User\Transformer as UserTransformers;
use Flugg\Responder\Responder;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    private $user;

    /**
     * Create a new controller instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verify(Request $request, Responder $responder): JsonResponse
    {
        $user = $this->user->find($request->id);
        if (!hash_equals((string) $request->id, (string) $user->getKey())) {
            throw new AuthorizationException;
        }

        if (!hash_equals((string) $request->hash, sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($user->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        Auth::loginUsingId($request->id);

        return $responder
            ->success($user, UserTransformers::class)
            ->respond()
        ;
    }
}
