<?php

namespace App\UseCases\App;

use App\Models\User;
use DB;

class UpdateUserProfileUseCase
{
    public function __invoke(int $userId, array $attributes): User
    {
        return DB::transaction(function () use ($userId, $attributes) {
            $user = User::findOrFail($userId);
            $profileAttributes = $attributes['profile'];
            $user
                ->profile
                ->fill($profileAttributes)
                ->save()
            ;

            foreach ($profileAttributes['sites'] as $key => $value) {
                if (isset($value['url'])) {
                    $user
                        ->profile
                        ->sites()
                        ->updateOrCreate(
                            ['providor' => $key],
                            ['url' => $value['url']]
                        );
                }
            }

            $user
                ->mainEmployee
                ->fill($attributes['mainEmployee'])
                ->save();

            $user->load([
                'profile',
                'mainEmployee',
                'mainEmployee.company',
                'employees',
                'employees.company'
            ]);

            return $user;
        });
    }
}
