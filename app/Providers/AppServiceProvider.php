<?php

namespace App\Providers;

use App\Company;
use App\Contact;
use App\Menu;
use App\Observers\ContactObserver;
use App\Observers\MenuObserver;
use App\Observers\OrderObserver;
use App\Order;
use App\User;
use App\Observers\CompanyObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Company::observe(CompanyObserver::class);
        Order::observe(OrderObserver::class);
        Menu::observe(MenuObserver::class);
        Contact::observe(ContactObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
