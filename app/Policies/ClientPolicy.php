<?php

namespace App\Policies;

use App\User;
use App\Client;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Client $client)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Client $client)
    {
        if ($user->type != "admin") {
            return $user->id === $client->user_id;
        }
        return true;
    }

    public function delete(User $user, Client $client)
    {
        if ($user->type != "admin") {
            return $user->id === $client->user_id;
        }
        return true;
    }
}
