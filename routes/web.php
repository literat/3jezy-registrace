<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

$s = 'social.';
Route::get('/social/redirect/{provider}',   ['as' => $s . 'redirect',   'uses' => 'Auth\SocialController@getSocialRedirect']);
Route::get('/social/handle/{provider}',     ['as' => $s . 'handle',     'uses' => 'Auth\SocialController@getSocialHandle']);

Route::group(['prefix' => 'admin', 'middleware' => 'auth:administrator'], function()
{
    $a = 'admin.';
    Route::get('/', ['as' => $a . 'home', 'uses' => 'AdminController@getHome']);

});

Route::group(['prefix' => 'user', 'middleware' => 'auth:user'], function()
{
    $a = 'user.';
    Route::get('/', ['as' => $a . 'home', 'uses' => 'UserController@getHome']);

    Route::group(['middleware' => 'activated'], function ()
    {
        $m = 'activated.';
        Route::get('protected', ['as' => $m . 'protected', 'uses' => 'UserController@getProtected']);
    });

});

Route::group(['middleware' => 'auth:all'], function()
{
    Route::get('/');

    $s = 'all.';
    Route::get('/dashboard', ['as' => $s . 'dashboard', 'uses' => 'PagesController@getHome']);
    Route::get('/constraints', ['as' => $s . 'constraints', 'uses' => 'PagesController@getHome']);
    Route::get('/checkpoints', ['as' => $s . 'checkpoints', 'uses' => 'PagesController@getHome']);
    Route::get('/competitors', ['as' => $s . 'competitors', 'uses' => 'PagesController@getHome']);
    Route::get('/teams', ['as' => $s . 'teams', 'uses' => 'PagesController@getHome']);
    Route::get('/settings', ['as' => $s . 'settings', 'uses' => 'PagesController@getHome']);

    Route::resource('users',               'UsersController');
    Route::resource('roles',               'RolesController');
    Route::resource('contests',            'ContestsController');
    Route::resource('contests.categories', 'CategoriesController');

    $a = 'authenticated.';
    Route::get('/logout', ['as' => $a . 'logout', 'uses' => 'Auth\LoginController@logout']);
    Route::get('/activate/{token}', ['as' => $a . 'activate', 'uses' => 'ActivateController@activate']);
    Route::get('/activate', ['as' => $a . 'activation-resend', 'uses' => 'ActivateController@resend']);
    Route::get('not-activated', ['as' => 'not-activated', 'uses' => function () {
        return view('errors.not-activated');
    }]);
});

Auth::routes(['login' => 'auth.login']);