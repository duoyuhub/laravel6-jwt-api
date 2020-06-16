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


Route::group([

    'namespace'  => 'Api',
    'prefix'     => 'v1',
    'middleware' => 'cors'

], function ($router) {
    Route::post('/users','UserController@store')->name('users.store');
    Route::post('/login','UserController@login')->name('users.login');

    /* token 验证接口 */
    Route::group([
        'middleware'=>['api.refresh']
    ], function() {
        Route::get('/users/info', 'UserController@info')->name('users.info');
        Route::get('/users', 'UserController@index')->name('users.index');
        Route::get('/logout', 'UserController@logout')->name('users.logout');

    });


    /* 管理员 */
    Route::group([
        'middleware'=>['admin.guard']
    ], function() {
        Route::post('/admins', 'AdminController@store')->name('admins.store');
        Route::post('/admin/login', 'AdminController@login')->name('admins.login');

        /* token 验证接口 */
        Route::group([
            'middleware'=>['api.refresh']
        ], function() {
            Route::get('/admins/info', 'AdminController@info')->name('admins.info');
            Route::get('/admins', 'AdminController@index')->name('admins.index');
            Route::get('/admins/{user}', 'AdminController@show')->name('admins.show');
            Route::get('/admins/logout', 'AdminController@logout')->name('admins.logout');

        });
    });

});
