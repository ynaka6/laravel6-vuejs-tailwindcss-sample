<?php

namespace App\Models;

use App\Enums\Models\UserProfileSite\Providor;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfileSite extends Model
{
    use CastsEnums;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_profile_id',
        'providor',
        'url',
    ];

    protected $enumCasts = [
        'providor' => Providor::class,
    ];

    public function userProfile(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class);
    }
}
