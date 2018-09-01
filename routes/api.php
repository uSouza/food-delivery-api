<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/v1/contacts', 'ContactsController@store');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->prefix('v1')->group(function () {
    Route::get('users/me', 'UsersController@me');
    Route::get('/interest', 'InterestsController@count');
    Route::get('/additionals_company/{id}', 'CompaniesController@getAdditionalsFromCompany');
    Route::get('/users/{email}', 'UsersController@findUserByEmail');
    Route::post('/products/menu/email', 'ProductsController@productsByMenu');
    Route::get('/menus/company/{id}', 'MenusController@menusByCompany');
    Route::get('/orders/client/{id}', 'OrdersController@ordersByClient');
    Route::get('/ingredient_groups/menu/{id}', 'IngredientGroupsController@ingredientsByMenu');
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
    ]);
});
