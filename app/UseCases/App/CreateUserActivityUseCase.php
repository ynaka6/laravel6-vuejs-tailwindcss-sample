<?php

namespace App\UseCases\App;

use App\Models\UserActivity;

class CreateUserActivityUseCase
{

    private $activity;

    public function __construct(UserActivity $activity)
    {
        $this->activity = $activity;
    }

    public function handle(array $attributes): UserActivity
    {
        return $this->activity->create($attributes);
    }
}
