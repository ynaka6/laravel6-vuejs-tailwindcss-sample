<?php

namespace App\Providers;

use App\Events\App\FollowedUser;
use App\Events\App\UnfollowedUser;
use App\Events\App\UpdatedPassword;
use App\Events\App\UpdatedProfile;
use App\Events\App\ViewedUserDetail;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        FollowedUser::class => [
            \App\Listeners\App\FollowedUserListener::class,
        ],
        UnfollowedUser::class => [
            \App\Listeners\App\UnfollowedUserListener::class,
        ],
        Login::class => [
            \App\Listeners\App\LoginListener::class,
        ],
        Logout::class => [
            \App\Listeners\App\LogoutListener::class,
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UpdatedPassword::class => [
            \App\Listeners\App\UpdatedPasswordListener::class
        ],
        UpdatedProfile::class => [
            \App\Listeners\App\UpdatedProfileListener::class
        ],
        ViewedUserDetail::class => [
            \App\Listeners\App\ViewedUserDetailListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
