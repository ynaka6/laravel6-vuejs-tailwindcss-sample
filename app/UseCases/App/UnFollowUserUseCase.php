<?php

namespace App\UseCases\App;

use App\Models\User;

class UnFollowUserUseCase
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    } 

    public function __invoke(int $userId, int $targetId): array
    {
        $user = $this->user->findOrFail($userId);
        $target = $this->user->findOrFail($targetId);
        $user->unfollow($target);
        return [ $target, $target->followers()->count()];
    }
}
