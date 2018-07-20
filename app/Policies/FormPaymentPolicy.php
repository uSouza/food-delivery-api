<?php

namespace App\Policies;

use App\User;
use App\FormPayment;
use Illuminate\Auth\Access\HandlesAuthorization;

class FormPaymentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the formPayment.
     *
     * @param  \App\User  $user
     * @param  \App\FormPayment  $formPayment
     * @return mixed
     */
    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    public function view(User $user, FormPayment $formPayment)
    {
        return $user->type === "company";
    }

    /**
     * Determine whether the user can create formPayments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the formPayment.
     *
     * @param  \App\User  $user
     * @param  \App\FormPayment  $formPayment
     * @return mixed
     */
    public function update(User $user, FormPayment $formPayment)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the formPayment.
     *
     * @param  \App\User  $user
     * @param  \App\FormPayment  $formPayment
     * @return mixed
     */
    public function delete(User $user, FormPayment $formPayment)
    {
        return false;
    }
}
