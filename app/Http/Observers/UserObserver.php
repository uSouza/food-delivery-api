<?php

namespace App\Observers;

use App\User;

class UserObserver
{
    public function creating(User $user)
    {
        var_dump('Creating');
        \Mail::to($user)->send(new \App\Mail\UserRegistered($user));
    }
}

