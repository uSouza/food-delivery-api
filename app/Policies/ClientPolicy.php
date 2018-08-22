<?php

namespace App\Policies;

use App\User;
use App\Client;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    public function view(User $user, Client $client)
    {
        return $user->id === $client->user_id;
    }

    public function create(User $user)
    {
        return $user->type === "client";
    }

    public function update(User $user, Client $client)
    {
        return $user->id === $client->user_id;
    }

    public function delete(User $user, Client $client)
    {
        return $user->id === $client->user_id;
    }
}
