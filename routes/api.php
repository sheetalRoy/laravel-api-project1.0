<?php

use Illuminate\Http\Request;
// use App\Http\Middleware\Cors;
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
/* User route */
// Route::group(['middleware' => 'cors'], function(){
    Route::post('login', 'Api\UserController@login');
    Route::post('register', 'Api\UserController@register');
    Route::get('getUsers', 'Api\UserController@getUsers');
    Route::get('getCoaches', 'Api\CoachesController@getCoaches');
    Route::post('saveCoaches', 'Api\CoachesController@saveCoaches');
    Route::put('updateCoaches/{id}', 'Api\CoachesController@updateCoaches');
    Route::get('getRelation','Api\CoachesController@getRelation');
// });  
