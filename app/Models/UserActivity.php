<?php

namespace App\Models;

use App\Models\Interfaces\PaginateModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Pagination\LengthAwarePaginator;

class UserActivity extends Model implements PaginateModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'message',
        'path',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters)
    {
        return $query
            ->when($filters['user_id'] ?? null, function ($query, $search) {
                $query->where('user_id', $search);
            })
        ;
    }

    /**
     * @override App\Models\Interfaces\PaginateModel@paginateByCondition
     */
    public function paginateByCondition(array $condition): LengthAwarePaginator
    {
        return $this
            ->filter($condition)
            ->orderBy('id', 'desc')
            ->paginate()
        ;
    }
}
