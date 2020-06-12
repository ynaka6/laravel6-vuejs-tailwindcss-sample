<?php

namespace App\Models;

use App\Models\Interfaces\ShowModel;
use App\Models\Interfaces\UpdateModel;
use App\Notifications\App\User\ResetEmail;
use App\Notifications\App\User\ResetPassword;
use App\Notifications\App\User\VerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail, ShowModel, UpdateModel
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'email_verified_at',
        'initialized',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    public function mainEmployee(): HasOne
    {
        return $this->hasOne(Employee::class)
            ->where('main', true)
        ;
    }

    public function activities(): HasMany
    {
        return $this->hasMany(UserActivity::class);
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function userResetEmails(): HasMany
    {
        return $this->hasMany(UserResetEmail::class);
    }

    public function relationshipFollowers(): HasMany
    {
        return $this->hasMany(UserRelationship::class, 'follow_id', 'id');
    }

    public function relationshipFollows(): HasMany
    {
        return $this->hasMany(UserRelationship::class, 'follower_id', 'id');
    }

    public function companies(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                Company::class,
                'employees',
                'user_id',
                'company_id'
            );
    }

    public function followers(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                self::class,
                'user_relationships',
                'follow_id',
                'follower_id'
            )
            ->whereNull('user_relationships.deleted_at');
    }

    public function follows(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                self::class,
                'user_relationships',
                'follower_id',
                'follow_id'
            )
            ->whereNull('user_relationships.deleted_at');
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
     * @override App\Models\Interfaces\ShowModel@firstByCondition
     */
    public function firstByCondition(array $condition)
    {
        return $this
            ->with([
                'profile',
                'mainEmployee',
                'mainEmployee.company',
                'employees',
                'employees.company',
            ])
            ->when($condition['id'] ?? $condition['userId'] ?? null, function ($query, $userId) {
                $query->where('id', $userId);
            })
            ->when($condition['profileStatus'] ?? null, function ($query, $profileStatus) {
                $query->whereHas('profile', function ($query) use ($profileStatus) {
                    $query->where('status', $profileStatus->value);
                });
            })
            ->firstOrFail();
    }

    public function findUserResetEmail(int $id): ?UserResetEmail
    {
        return $this->userResetEmails()->find($id);
    }

    public function requestResetEmail(array $attributes): void
    {
        $userResetEmail = $this->userResetEmails()->updateOrCreate([ 'user_id' => $this->id ], $attributes);
        $userResetEmail->sendEmailResetNotification();
    }

    public function following(self $user): bool
    {
        return $this->relationshipFollows()->where('follow_id', $user->id)->count() > 0;
    }

    public function follow(self $user): void
    {
        $relationship = $this->relationshipFollows()->withTrashed()->firstOrCreate(['follow_id' => $user->id]);
        $relationship->restore();
    }

    public function unfollow(self $user): void
    {
        $this->relationshipFollows()->where('follow_id', $user->id)->delete();
    }


    /**
     * メール認証用のメール送信
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmail());
    }

    /**
     * パスワード再設定メールの送信
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPassword($this->email, $token));
    }
}
