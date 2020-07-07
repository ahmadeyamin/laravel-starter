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

Route::view('/', 'welcome')->name('index');
Route::get('test', function () {
    dump(Gate::check('app.dashboard'));
});
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
    Route::resource('permissions', 'Admin\PermissionController');

    // Module is group of permission section of permission
    Route::resource('modules', 'Admin\moduleController');

});

