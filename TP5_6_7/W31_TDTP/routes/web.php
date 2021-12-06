<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureMyUserIsAuthenticated;
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
Route::group([], function()
{
    session_start();

    Route::get('/', [UserController::class, 'signin']);
    
    Route::post('adduser', function () {
        return view('adduser');
    })->name('adduser');
    Route::post('authenticate', function () {
        return view('authenticate');
    })->name('authenticate');

    Route::get('signin', [UserController::class, 'signin'])->name('signin');
    Route::get('signup', [UserController::class, 'signup'])->name('signup');

    Route::prefix('admin')
    ->name('admin')
    ->middleware('auth.myuser')
    ->group(
        function()
        {
            Route::get('account', [UserController::class, 'account'])->name('account');
            Route::post('changepassword', function () {
                return view('changepassword');
            })->name('changepassword');
            Route::get('deleteuser', function () {
                return view('deleteuser');
            })->name('deleteuser');
            Route::get('formpassword', [UserController::class, 'formpassword'])->name('formpassword');
            Route::get('signout', [UserController::class, 'signout'])->name('signout');
        }
    );
});