<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::resource('users','UserController');
// Route::resource('roles','RoleController');
// Route::get('/role_user/{id}','UserController@show_user_by_role');


Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');
// Route::get('logout', 'ApiController@logout');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::resource('roles','RoleController');
    Route::resource('permissions','PermissionController');
    Route::resource('users','UserController');
    Route::get('/role_user/{id}','UserController@show_user_by_role');
    Route::get('/users_by_roles','UserController@all_users_by_role');
});
