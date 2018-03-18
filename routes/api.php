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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->prefix('v1')->group(function () {
    Route::get('users/me', function () {
       return request()->user();
    });
    Route::get('/interest', 'InterestsController@count');
    Route::resources([
        'clients' => 'ClientsController',
        'users' => 'UsersController',
        'companies' => 'CompaniesController',
        'form_payments' => 'FormPaymentsController',
        'products' => 'ProductsController',
        'ingredients' => 'IngredientsController',
        'locations' => 'LocationsController',
        'tags' => 'TagsController',
        'orders' => 'OrdersController',
        'prices' => 'PricesController',
        'status' => 'StatusController',
    ]);
});
