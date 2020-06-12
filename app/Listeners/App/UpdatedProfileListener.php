<?php

namespace App\Listeners\App;

use App\Events\App\UpdatedProfile as UpdatedProfileEvent;
use App\UseCases\App\CreateUserActivityUseCase;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdatedProfileListener implements ShouldQueue
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
     * @param  App\Events\App\UpdatedProfile  $event
     * @return void
     */
    public function handle(UpdatedProfileEvent $event)
    {
        $this->usecase->handle([
            'user_id' => $event->user()->id,
            'message' => __('messages.user.activity.updated_profile')
        ]);
    }
}
