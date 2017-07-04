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

Route::get('/user', function (Request $request) {
    return $request->user();
});

/*
 * Api Interface Routes
 * Namespaces indicate folder structure
 */
Route::group(['as' => 'api.', 'middleware' => 'guest.api'], function () {
    Route::resource('login', 'LoginAPIController', ['only' => ['store', 'index']]);
    Route::resource('register', 'RegisterAPIController', ['only' => ['store']]);
});

/*
 * Api Interface Routes
 * Namespaces indicate folder structure
 */
Route::group(['as' => 'api.', 'middleware' => 'auth.api'], function () {

});
