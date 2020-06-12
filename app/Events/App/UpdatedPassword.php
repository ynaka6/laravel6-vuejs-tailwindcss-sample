<?php

namespace App\Events\App;

use App\Models\User;
use Illuminate\Queue\SerializesModels;

class UpdatedPassword
{
    use SerializesModels;

    private $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function user(): User
    {
        return $this->user;
    }
}
