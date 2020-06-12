<?php

namespace App\Listeners\App;

use App\UseCases\App\CreateUserActivityUseCase;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Logout as EventLogout;

class LogoutListener implements ShouldQueue
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
     * @param  Illuminate\Auth\Events\Logout $event
     * @return void
     */
    public function handle(EventLogout $event)
    {
        if ($event->user) {
            $this->usecase->handle([
                'user_id' => $event->user->id,
                'message' => __('messages.user.activity.logout')
            ]);
        }
    }
}
