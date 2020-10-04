<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\Admin\HomeController;
use App\Http\Controllers\Backend\Admin\MenuController;
use App\Http\Controllers\Backend\Admin\PageController;
use App\Http\Controllers\Backend\Admin\RoleController;
use App\Http\Controllers\Backend\Admin\UserController;
use App\Http\Controllers\Backend\Admin\BackupController;
use App\Http\Controllers\Backend\Admin\SettingController;
use App\Http\Controllers\Backend\Admin\PermissionController;

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

// Socialite routes
Route::group(['as'=>'login.','prefix'=>'login','namespace'=>'Auth'], function () {
    Route::get('{provider}', [LoginController::class,'redirectToProvider'])->name('provider');
    Route::get('{provider}/callback', [LoginController::class,'handleProviderCallback'])->name('callback');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


// All Route For Auth user
Route::group(['middleware' => ['auth:sanctum', 'verified'],'prefix' => 'app','as'=>'backend.'], function () {

    //Admin Home Page
    Route::get('home', [HomeController::class,'index'])->name('home');

    //User Controller
    Route::resource('users', UserController::class)->only(['index','create','edit','show']);

    //User Roles Controller
    Route::resource('roles', RoleController::class)->only(['index','create','edit','show']);

    //Premissions of role
    Route::resource('permissions', PermissionController::class)->only(['index']);

    // Module is group of permission section of permission
    Route::resource('pages', PageController::class);

    // Menu Controller
    Route::resource('menus', MenuController::class)->only(['index']);
    Route::get('menus/{menu}/builder', [MenuController::class,'builder'])->name('menus.builder');

    //Backups Route
    Route::get('backups', [BackupController::class,'index'])->name('backups.index');
    Route::get('backups/create', [BackupController::class,'create'])->name('backups.create');
    Route::get('backups/download', [BackupController::class,'download'])->name('backups.download');
    Route::get('backups/delete', [BackupController::class,'delete'])->name('backups.delete');

    //Settings Route
    Route::get('settings', [SettingController::class,'index'])->name('settings.index');
    Route::post('settings', [SettingController::class,'update'])->name('settings.update');


});

