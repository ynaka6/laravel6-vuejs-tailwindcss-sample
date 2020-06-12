<?php

namespace App\Models;

use App\Models\Interfaces\PaginateModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;

class Company extends Model implements PaginateModel
{
    protected $fillable = [
        'name',
        'name_kana',
        'ceo',
        'founded',
        'url',
        'email',
        'tel',
        'fax',
        'postal_code',
        'address',
        'business',
        'plan_slug',
    ];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class, 'plan_slug', 'slug');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function businessCategories(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                BusinessCategory::class,
                'company_business_categories',
                'company_id',
                'business_category_id'
            );
    }

    public function users(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                User::class,
                'employees',
                'company_id',
                'user_id'
            );
    }

    public function scopeFilter($query, array $filters)
    {
        return $query
            ->when($filters['name'] ?? null, function ($query, $search) {
                $query->where('name', $search);
            })
            ->when($filters['bothLikeName'] ?? null, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($filters['prefLikeName'] ?? null, function ($query, $search) {
                $query->where('name', 'like', $search . '%');
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
            ->paginate();
    }
}
