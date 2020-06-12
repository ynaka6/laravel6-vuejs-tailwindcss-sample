<?php

namespace App\Models;

use App\Models\Interfaces\PaginateModel;
use App\Models\Interfaces\CreateModel;
use App\Models\Interfaces\ShowModel;
use App\Models\Interfaces\UpdateModel;
use App\Models\Interfaces\DeleteModel;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Pagination\LengthAwarePaginator;

class Admin extends Authenticatable implements PaginateModel, CreateModel, ShowModel, UpdateModel, DeleteModel
{
    use CastsEnums;

    protected $enumCasts = [
        'role' => \App\Enums\Models\Admin\Role::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function scopeFilter($query, array $filters)
    {
        return $query
            ->when($filters['bothLikeName'] ?? null, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($filters['bothLikeEmail'] ?? null, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($filters['role'] ?? null, function ($query, $search) {
                $query->where('role', $search);
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
    /**
     * @override App\Models\Interfaces\CreateModel@create
     */
    public function create(array $attributes)
    {
        return parent::create($attributes);
    }
    /**
     * @override App\Models\Interfaces\ShowModel@firstByCondition
     */
    public function firstByCondition(array $condition)
    {
        return $this
            ->when($condition['id'] ?? null, function ($query, $id) {
                $query->where('id', $id);
            })
            ->first();
    }
    /**
     * @override App\Models\Interfaces\UpdateModel@updateOrCreate
     */
    public function updateOrCreate(array $condition, array $attribute)
    {
        parent::updateOrCreate($condition, $attribute);
        return $this;
    }
    /**
     * @override App\Models\Interfaces\DeleteModel@deleteByCondition
     */
    public function deleteByCondition(array $condition): void
    {
        $this
            ->when($condition['id'] ?? null, function ($query, $id) {
                $query->where('id', $id);
            })
            ->delete()
        ;
    }
}
