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
Route::group([], function()
{
    session_start();

    Route::get('/', [UserController::class, 'signin']);
    
    Route::post('adduser', function () {
        return view('adduser');
    });
    Route::post('authenticate', function () {
        return view('authenticate');
    });

    Route::get('signin', [UserController::class, 'signin']);
    Route::get('signup', [UserController::class, 'signup']);

    Route::prefix('admin')
    ->middleware('auth.myuser')
    ->group(function()
    {
        Route::get('account', [UserController::class, 'account']);
        Route::post('changepassword', function () {
            return view('changepassword');
        });
        Route::get('deleteuser', function () {
            return view('deleteuser');
        });
        Route::get('formpassword', [UserController::class, 'formpassword']);
        Route::get('signout', [UserController::class, 'signout']);
    });

    
});