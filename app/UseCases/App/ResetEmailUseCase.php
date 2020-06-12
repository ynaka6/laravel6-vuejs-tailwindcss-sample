<?php

namespace App\UseCases\App;

use App\Models\User;
use DB;

class ResetEmailUseCase
{
    public function __invoke(int $userId, array $attributes): void
    {
        DB::transaction(function () use ($userId, $attributes) {
            $user = User::findOrFail($userId);
            $user->requestResetEmail($attributes);
        });
    }
}
