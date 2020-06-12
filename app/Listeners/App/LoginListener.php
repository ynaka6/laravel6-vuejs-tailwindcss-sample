<?php

namespace App\Listeners\App;

use App\UseCases\App\CreateUserActivityUseCase;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login as LoginEvent;

class LoginListener implements ShouldQueue
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
     * @param  Illuminate\Auth\Events\Login $event
     * @return void
     */
    public function handle(LoginEvent $event)
    {
        $this->usecase->handle([
            'user_id' => $event->user->id,
            'message' => __('messages.user.activity.login')
        ]);
    }
}
