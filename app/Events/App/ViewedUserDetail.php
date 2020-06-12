<?php

namespace App\Events\App;

use App\Models\User;
use Illuminate\Queue\SerializesModels;

class ViewedUserDetail
{
    use SerializesModels;

    private $target;

    private $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $target, User $user)
    {
        $this->target = $target;
        $this->user = $user;
    }

    public function target(): User
    {
        return $this->target;
    }

    public function user(): User
    {
        return $this->user;
    }

    public function isSameUser(): bool
    {
        return $this->user->id === $this->target->id;
    }

    public function path(): string
    {
        return '/user/' . $this->target->id;
    }
}
