<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\SingleController;
use App\Http\Controllers\CategoryController;

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

define('PAGINATION',20);

Route::get('/', [HomeController::class , 'index']);

Route::get('single/{slag}', [SingleController::class , 'index'])->name('single');

Route::get('login', [LoginController::class , 'index'])->name('login');
Route::post('login', [LoginController::class , 'save']);

Route::get('logout',[LogoutController::class , 'logout'])->name('logout');

Route::get('register', [SignupController::class , 'index']);
Route::post('register', [SignupController::class , 'save']);

/** admin routes */

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/' , [AdminController::class , 'index']);

    Route::resource('posts', PostController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('users', UsersController::class);

});