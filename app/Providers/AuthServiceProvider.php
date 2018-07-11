<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Client' => 'App\Policies\ClientPolicy',
        'App\Company' => 'App\Polices\CompanyPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Passport::enableImplicitGrant();
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(15)); //controlando a validade do refresh token
        Passport::tokensExpireIn(Carbon::now()->addDays(5)); //controlando a valiade do token de acesso
    }
}
