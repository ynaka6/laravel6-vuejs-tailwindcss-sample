<?php

namespace App\Listeners\App;

use App\Events\App\UnfollowedUser as UnfollowedUserEvent;
use App\UseCases\App\CreateUserActivityUseCase;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UnfollowedUserListener
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
     * @param  App\Events\App\UnfollowedUser $event
     * @return void
     */
    public function handle(UnfollowedUserEvent $event)
    {
        $message = __('messages.user.activity.unfollowed_user', [
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
