<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRelationship extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'follower_id',
        'follow_id',
    ];

    /**
     * 日付へキャストする属性.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function follower(): BelongsTo
    {
        return $this->belongsTo(User::class, 'follower_id', 'id');
    }

    public function follow(): BelongsTo
    {
        return $this->belongsTo(User::class, 'follow_id', 'id');
    }

}
