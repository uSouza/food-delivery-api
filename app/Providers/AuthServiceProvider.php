<?php

namespace App\Providers;

use App\Client;
use App\Company;
use App\FormPayment;
use App\Ingredient;
use App\IngredientGroup;
use App\Location;
use App\Order;
use App\Policies\ClientPolicy;
use App\Policies\CompanyPolicy;
use App\Policies\FormPaymentPolicy;
use App\Policies\IngredientPolicy;
use App\Policies\LocationPolicy;
use App\Policies\OrderPolicy;
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
        Company::class => CompanyPolicy::class,
        Client::class => ClientPolicy::class,
        Order::class => OrderPolicy::class,
        FormPayment::class => FormPaymentPolicy::class,
        IngredientGroup::class => IngredientGroup::class,
        IngredientPolicy::class => Ingredient::class
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
