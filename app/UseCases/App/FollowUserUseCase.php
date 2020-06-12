<?php

namespace App\UseCases\App;

use App\Models\User;

class FollowUserUseCase
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
        $user->follow($target);
        return [ $target, $target->followers()->count()];
    }
}
