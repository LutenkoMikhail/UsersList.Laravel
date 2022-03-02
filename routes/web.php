<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;

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
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/login/{social}', [App\Http\Controllers\Auth\LoginController::class,'socialLogin'])
    ->where('social', 'twitter|facebook|linkedin|google|github|bitbucket');
Route::get('/login/{social}/callback', [App\Http\Controllers\Auth\LoginController::class,'handleProviderCallback'])
    ->where('social', 'twitter|facebook|linkedin|google|github|bitbucket');

Route::middleware(['auth', 'admin'])->prefix('admin_panel')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('homeAdmin');
    Route::post('/user/blocked/{user}/', [App\Http\Controllers\Admin\UserController::class, 'changeStatus'])->name('user.changeStatus');
    Route::resource('user', App\Http\Controllers\Admin\UserController::class);
});

