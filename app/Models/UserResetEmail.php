<?php

namespace App\Models;

use App\Notifications\App\User\ResetEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class UserResetEmail extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'email',
        'token',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * メールアドレス変更メールの送信
     *
     * @param string $email
     */
    public function sendEmailResetNotification(): void
    {
        $this->notify(new ResetEmail());
    }
}
