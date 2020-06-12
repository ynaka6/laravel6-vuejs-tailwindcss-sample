<?php

namespace App\Transformers\User;

use App\Models\User;
use App\Transformers\UserProfile\Transformer as UserProfileTransformer;
use App\Transformers\Employee\Transformer as EmployeeTransformer;
use Flugg\Responder\Transformers\Transformer as AbstructTransformer;

class Transformer extends AbstructTransformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [
        'profile'       => UserProfileTransformer::class,
        'mainEmployee'  => EmployeeTransformer::class,
        'employees'     => EmployeeTransformer::class,
    ];

    /**
     * Transform the model.
     *
     * @param  \App\App $app
     * @return array
     */
    public function transform(User $user): array
    {
        return [
            'id' => (int) $user->id,
            'email' => $user->email,
            'initialized' => $user->initialized,
        ];
    }
}
