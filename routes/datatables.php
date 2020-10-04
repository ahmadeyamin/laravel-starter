<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataTablesController;

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

Route::group(['middleware' => ['web']], function () {
    Route::get('users/', [DataTablesController::class,'users'])->name('users');
    Route::get('roles/', [DataTablesController::class,'roles'])->name('roles');
    // Route::get('modules/', [DataTablesController::class,'modules'])->name('modules');
    Route::get('permissions/', [DataTablesController::class,'permissions'])->name('permissions');
});
