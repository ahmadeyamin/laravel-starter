<?php

use App\Models\Permission;
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
Route::get('test', function () {
    return Permission::with('module')->get()->groupBy('module.name');
});
Route::view('/', 'welcome')->name('index');

Auth::routes();
// Socialite routes
Route::group(['as'=>'login.','prefix'=>'login','namespace'=>'Auth'], function () {
    Route::get('{provider}', 'LoginController@redirectToProvider')->name('provider');
    Route::get('{provider}/callback', 'LoginController@handleProviderCallback')->name('callback');
});


Route::group(['middleware' => ['auth'],'prefix' => 'app','namespace'=>'Backend','as'=>'backend.'], function () {
    Route::get('home', 'Admin\HomeController@index')->name('home');
    Route::resource('users', 'Admin\UserController');
    Route::resource('roles', 'Admin\RoleController');
});

