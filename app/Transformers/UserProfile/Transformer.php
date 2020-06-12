<?php

namespace App\Transformers\UserProfile;

use App\Models\UserProfile;
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
     * @param  App\Models\UserProfile $profile
     * @return array
     */
    public function transform(UserProfile $profile): array
    {
        return [
            'id'            => (int) $profile->id,
            'name'          => $profile->name,
            'nameKana'      => $profile->name_kana,
            'birthday'      => (object) [
                'full'  => optional($profile->birthday)->format('Y-m-d'),
                'year'  => optional($profile->birthday)->year,
                'month' => optional($profile->birthday)->month,
                'day'   => optional($profile->birthday)->day,
            ],
            'gender'        => $profile->gender,
            'status'        => $profile->status,
            'detail'        => $profile->detail,
            'sites'         => $profile->getSitesMap()
        ];
    }
}
