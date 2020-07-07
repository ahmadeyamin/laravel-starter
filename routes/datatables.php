<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['web','auth']], function () {
    Route::get('users/', 'DataTablesController@users')->name('users');
    Route::get('roles/', 'DataTablesController@roles')->name('roles');
    Route::get('modules/', 'DataTablesController@modules')->name('modules');
    Route::get('permissions/', 'DataTablesController@permissions')->name('permissions');
});
