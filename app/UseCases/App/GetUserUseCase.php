<?php

namespace App\UseCases\App;

use App\Models\User;

class GetUserUseCase
{
    private $user;

    public function __construct(
        User $user
    ) {
        $this->user = $user;
    }

    public function __invoke(int $userId): User
    {
        return $this->user
            ->with([
                'profile',
                'mainEmployee',
                'mainEmployee.company',
                'employees',
                'employees.company',
            ])
            ->findOrFail($userId)
        ;
    }
}
