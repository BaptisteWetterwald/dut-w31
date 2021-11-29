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

    Route::prefix('admin')
    ->middleware('auth.myuser')
    ->group(function()
    {

        Route::get('account', function () {
            return view('account', ['message'=>$_SESSION['message'] ?? null], ['user'=>$_SESSION['user']]);
        });
        Route::post('changepassword', function () {
            return view('changepassword');
        });
        Route::get('deleteuser', function () {
            return view('deleteuser');
        });
        Route::get('formpassword', function () {
            return view('formpassword', ['message'=>$_SESSION['message'] ?? null]);
        });
        Route::get('signout', function () {
            session_destroy();
            return redirect('signin');
        });
    });

    Route::get('signin', function () {
        return view('signin', ['message'=>$_SESSION['message'] ?? null]);
    });

    Route::get('signup', function () {
        return view('signup', ['message'=>$_SESSION['message'] ?? null]);
    });
});