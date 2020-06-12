<?php

namespace App\Transformers\UserActivity;

use App\Models\UserActivity;
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
    protected $load = [];

    /**
     * Transform the model.
     *
     * @param  App\Models\UserActivity $profile
     * @return array
     */
    public function transform(UserActivity $activity): array
    {
        return [
            'id'            => (int) $activity->id,
            'message'       => (string) $activity->message,
            'path'          => (string) $activity->path,
            'datetime'      => $activity->created_at->format('Y-m-d H:i')
        ];
    }
}
