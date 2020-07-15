<?php

use App\Models\Setting;
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
    Setting::set('app.sdfd','ok');
    return Setting::getAllSettings();
});
Route::view('/', 'welcome')->name('index');

Auth::routes();
// Socialite routes
Route::group(['as'=>'login.','prefix'=>'login','namespace'=>'Auth'], function () {
    Route::get('{provider}', 'LoginController@redirectToProvider')->name('provider');
    Route::get('{provider}/callback', 'LoginController@handleProviderCallback')->name('callback');
});

// All Route For Auth user
Route::group(['middleware' => ['auth'],'prefix' => 'app','namespace'=>'Backend','as'=>'backend.'], function () {

    //Admin Home Page
    Route::get('home', 'Admin\HomeController@index')->name('home');

    //User Controller
    Route::resource('users', 'Admin\UserController')->only(['index','create','edit','show']);

    //User Roles Controller
    Route::resource('roles', 'Admin\RoleController')->only(['index','create','edit','show']);

    //Premissions of role
    Route::resource('permissions', 'Admin\PermissionController')->only(['index']);

    // Module is group of permission section of permission
    // Route::resource('modules', 'Admin\moduleController');

    // Menu Controller
    Route::resource('menus', 'Admin\MenuController');
    Route::get('menus/{menu}/builder', 'Admin\MenuController@builder')->name('menus.builder');

});

