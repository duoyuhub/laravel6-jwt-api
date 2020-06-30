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
    'middleware' => ['cors']

], function ($router) {
    /* 低频访问接口 */
    Route::middleware('throttle:30,1')->group(function() {
        /* 用户登陆 */
        Route::post('/users','UserController@store')->name('users.store');
        Route::post('/login','UserController@login')->name('users.login');

        /* 管理员登陆 */
        Route::middleware('admin.guard')->group(function() {
            Route::post('/admins', 'AdminController@store')->name('admins.store');
            Route::post('/admin/login', 'AdminController@login')->name('admins.login');
        });

        /* 测试接口 */
        Route::any('/index', 'ProductController@index');

    });

    /* 高频 token 验证接口 */
    Route::group([
        'middleware'=>['throttle:60,1']
    ], function() {
        /* 小程序相关接口 */
        Route::middleware('api.refresh')->group(function(){
            /* 用户相关接口 */
            Route::get('/users/info', 'UserController@info')->name('users.info');
            Route::get('/users', 'UserController@index')->name('users.index');
            Route::get('/logout', 'UserController@logout')->name('users.logout');
        });

        /* 管理系统关接口*/
        Route::middleware('admin.guard')->group(function(){
            /* 管理员相关接口*/
            Route::get('/admins/info', 'AdminController@info')->name('admins.info');
            Route::get('/admins', 'AdminController@index')->name('admins.index');
            Route::get('/admins/{user}', 'AdminController@show')->name('admins.show');
            Route::get('/admins/logout', 'AdminController@logout')->name('admins.logout');

            /* 商品相关接口 */
            Route::get('/categories', 'CategoryController@index')->name('goods.category.index');
            Route::post('/categories', 'CategoryController@store')->name('goods.category.store');
        });
    });

    /* 超高频工具接口 */


});
