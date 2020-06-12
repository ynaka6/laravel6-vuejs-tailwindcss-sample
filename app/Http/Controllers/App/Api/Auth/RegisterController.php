<?php

namespace App\Http\Controllers\App\Api\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Http\Requests\App\Auth\RegisterRequest;
use Flugg\Responder\Responder;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    private $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param App\Http\Requests\App\Auth\RegisterRequest; $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request, Responder $responder): JsonResponse
    {
        event(new Registered($user = $this->user->create($request->validated())));
        return $responder
            ->success()
            ->respond()
        ;
    }
}
