<?php

namespace App\Policies;

use App\User;
use App\Company;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Company $company)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Company $company)
    {
        return $user->id === $company->user_id;
    }

    public function delete(User $user, Company $company)
    {
        return $user->id === $company->user_id;
    }
}
