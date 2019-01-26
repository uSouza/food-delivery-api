<?php

use Illuminate\Http\Request;

Route::post('/v1/contacts', 'ContactsController@store');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/now', function () {
    return \Carbon\Carbon::now();
});

Route::middleware('auth:api')->get('/min_version', function () {
    return response()->json(['version' => '0.0.23']);
});

Route::middleware('auth:api')->prefix('v1')->group(function () {
    Route::get('users/me', 'UsersController@me');
    Route::get('/interest', 'InterestsController@count');
    Route::get('/additionals/company/{id}', 'AdditionalsController@getAdditionalsFromCompany');
    Route::get('/users/{email}', 'UsersController@findUserByEmail');
    Route::post('/products/menu/email', 'ProductsController@productsByMenu');
    Route::post('/users/one_signal', 'UsersController@setOneSignalId');
    Route::get('/menus/company/{id}', 'MenusController@menusByCompany');
    Route::get('/orders/client/{id}', 'OrdersController@ordersByClient');
    Route::get('/orders/open', 'OrdersController@getOpenOrders');
    Route::get('/orders/closed', 'OrdersController@getClosedOrders');
    Route::get('/ingredient_groups/menu/{id}', 'IngredientGroupsController@ingredientsByMenu');
    Route::get('/additionals/restore/{id}', 'AdditionalsController@restore');
    Route::get('/menus/restore/{id}', 'MenusController@restore');
    Route::get('companies/available', 'CompaniesController@getAvailableCompanies');
    Route::get('companies/available/city/{city_id}', 'CompaniesController@getAvailableCompaniesByCity');
    Route::get('orders/cancel/{id}', 'OrdersController@cancel');
    Route::get('companies_locations/company/{company_id}', 'CompaniesLocationsController@getLocationsByCompany');
    Route::get('districts/city/{city_id}', 'DistrictsController@getDistrictsByCity');
    Route::get('freights/company/{company_id}', 'FreightsController@getFreightsByCompany');
    Route::delete('service_hours/company/{company_id}', 'ServiceHoursController@destroyByCompany');
    Route::delete('freights/company/{company_id}', 'FreightsController@destroyByCompany');
    Route::post('password/create', 'PasswordResetController@create');
    Route::get('password/find/{token}', 'PasswordResetController@find');
    Route::post('password/reset', 'PasswordResetController@reset');

    Route::resources([
        'clients' => 'ClientsController',
        'users' => 'UsersController',
        'companies' => 'CompaniesController',
        'form_payments' => 'FormPaymentsController',
        'products' => 'ProductsController',
        'ingredients' => 'IngredientsController',
        'tags' => 'TagsController',
        'orders' => 'OrdersController',
        'prices' => 'PricesController',
        'status' => 'StatusController',
        'ingredient_groups' => 'IngredientGroupsController',
        'clients_locations' => 'ClientsLocationsController',
        'companies_locations' => 'CompaniesLocationsController',
        'order_evaluations' => 'OrderEvaluationsController',
        'worked_days' => 'WorkedDaysController',
        'additionals' => 'AdditionalsController',
        'menus' => 'MenusController',
        'service_hours' => 'ServiceHoursController',
        'states' => 'StatesController',
        'cities' => 'CitiesController',
        'districts' => 'DistrictsController',
        'freights' => 'FreightsController'
    ]);
});
