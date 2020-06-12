<?php

namespace App\Models;

use App\Enums\Models\UserProfileSite\Providor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserProfile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'name_kana',
        'birthday',
        'gender',
        'status',
        'detail',
    ];

    protected $with = [
        'sites'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sites(): HasMany
    {
        return $this->hasMany(UserProfileSite::class);
    }

    public function getSitesMap(): object
    {
        $array = [];
        $sites = $this->sites;
        foreach (Providor::getInstances() as $providor) {
            $site = $sites->firstWhere('providor.key', $providor->key);
            $array[$providor->value] = (object) [
                'key' => $providor->key,
                'value' => $providor->value,
                'description' => $providor->description,
                'icon' => $providor->icon,
                'url' => optional($site)->url,
            ];
        }
        return (object) $array;
    }
}
