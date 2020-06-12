<?php

namespace App\Listeners\App;

use App\Events\App\FollowedUser as FollowedUserEvent;
use App\UseCases\App\CreateUserActivityUseCase;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FollowedUserListener
{
    private $usecase;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CreateUserActivityUseCase $usecase)
    {
        $this->usecase = $usecase;
    }

    /**
     * Handle the event.
     *
     * @param  App\Events\App\FollowedUser $event
     * @return void
     */
    public function handle(FollowedUserEvent $event)
    {
        $message = __('messages.user.activity.followed_user', [
            'company' => $event->target()->mainEmployee->company->name,
            'name' => $event->target()->profile->name
        ]);

        $this->usecase->handle([
            'user_id' => $event->user()->id,
            'message' => $message,
            'path'    => $event->path()
        ]);
    }
}
