<?php

namespace App\Policies;

use App\User;
use App\Ingredient;
use Illuminate\Auth\Access\HandlesAuthorization;

class IngredientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the ingredient.
     *
     * @param  \App\User  $user
     * @param  \App\Ingredient  $ingredient
     * @return mixed
     */
    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    public function view(User $user, Ingredient $ingredient)
    {
        return true;
    }

    /**
     * Determine whether the user can create ingredients.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the ingredient.
     *
     * @param  \App\User  $user
     * @param  \App\Ingredient  $ingredient
     * @return mixed
     */
    public function update(User $user, Ingredient $ingredient)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the ingredient.
     *
     * @param  \App\User  $user
     * @param  \App\Ingredient  $ingredient
     * @return mixed
     */
    public function delete(User $user, Ingredient $ingredient)
    {
        return false;
    }
}
