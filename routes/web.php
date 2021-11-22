<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/migrate-table-users', function(){
    Artisan::call('migrate:refresh --path=/database/migrations/2014_10_12_000000_create_users_table.php');
    return "Users table is created";
});
Route::get('/migrate-table-address', function(){
    Artisan::call('migrate:refresh --path=/database/migrations/2014_10_12_000000_create_user_addresses_table.php');
    return "Address table is created";
});
Route::get('/migrate-table-coaches', function(){
    Artisan::call('migrate:refresh --path=/database/migrations/2021_10_27_035117_create_coaches_table.php');
    return "Coaches table is created";
});
Route::get('/migrate-table-area', function(){
    Artisan::call('migrate:refresh --path=/database/migrations/2021_10_27_150444_create_areas_table.php');
    return "Area table is created";
});
Route::get('/migrate-table-coaches-area', function(){
    Artisan::call('migrate:refresh --path=/database/migrations/2021_11_09_022340_create_coaches_areas_table.php');
    return "CoachesArea table is created";
});