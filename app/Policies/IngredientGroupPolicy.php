<?php

namespace App\Policies;

use App\User;
use App\IngredientGroup;
use Illuminate\Auth\Access\HandlesAuthorization;

class IngredientGroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the ingredientGroup.
     *
     * @param  \App\User  $user
     * @param  \App\IngredientGroup  $ingredientGroup
     * @return mixed
     */
    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    public function view(User $user, IngredientGroup $ingredientGroup)
    {
        return true;
    }

    /**
     * Determine whether the user can create ingredientGroups.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the ingredientGroup.
     *
     * @param  \App\User  $user
     * @param  \App\IngredientGroup  $ingredientGroup
     * @return mixed
     */
    public function update(User $user, IngredientGroup $ingredientGroup)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the ingredientGroup.
     *
     * @param  \App\User  $user
     * @param  \App\IngredientGroup  $ingredientGroup
     * @return mixed
     */
    public function delete(User $user, IngredientGroup $ingredientGroup)
    {
        return false;
    }
}
