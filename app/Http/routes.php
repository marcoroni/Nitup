<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', 'DashboardController@IndexHome');

    Route::get('/login', 'DashboardController@IndexLogin');

    Route::post('/login/request', 'AccountController@loginRequest');

    Route::get('/register', 'DashboardController@IndexRegister');
    Route::post('/register/request', 'AccountController@registerRequest');

    Route::get('/winkelwagen/betalen', [
        'middleware' => 'auth',
        'uses' => 'MollieController@PaymentRequest'
    ]);

    Route::get('/contact', [
        'middleware' => 'auth',
        'uses' => 'DashboardController@IndexContact'
    ]);

    Route::get('/winkelwagen/amount/{set}', [
        'middleware' => 'auth',
        'uses' => 'ProductController@productSet'
    ]);

    Route::get('/winkelwagen/{product}', [
        'middleware' => 'auth',
        'uses' => 'ProductController@productJoin'
    ]);
    Route::get('/winkelwagen/', [
        'middleware' => 'auth',
        'uses' => 'ProductController@productOverview'
    ]);

    Route::post('/product/add', [
        'middleware' => 'auth',
        'uses' => 'ProductController@productAdd'
    ]);
    Route::post('/product/del', [
        'middleware' => 'auth',
        'uses' => 'ProductController@productDel'
    ]);

    Route::get('/product/toevoegen', [
        'middleware' => 'auth',
        'uses' => 'DashboardController@productNew'
    ]);

    Route::post('/product/product/new/request', [
        'middleware' => 'auth',
        'uses' => 'ProductController@productNewRequest'
    ]);

    Route::get('/logout', [
        'middleware' => 'auth',
        'uses' => 'AccountController@logoutRequest'
    ]);

    Route::get('/games', 'DashboardController@IndexGames');
    Route::get('/games/{category}', 'DashboardController@IndexCategory');
    Route::get('/tetris', 'DashboardController@IndexTetris');
    Route::get('/mario', 'DashboardController@IndexMario');
    Route::get('/pacman', 'DashboardController@IndexPacman');
});
