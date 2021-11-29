<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the signin page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signin( Request $request )
    {
        return view('signin', ['message'=>$_SESSION['message'] ?? null]);
    }

    /**
     * Show the signup page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signup( Request $request )
    {
        return view('signup', ['message'=>$_SESSION['message'] ?? null]);
    }

    /**
     * Show the formpassword page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function formpassword( Request $request )
    {
        return view('formpassword', ['message'=>$_SESSION['message'] ?? null]);
    }

    /**
     * Show the signout page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signout( Request $request )
    {
        session_destroy();
        return redirect('signin');
    }

    /**
     * Show the account page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function account( Request $request )
    {
        return view('account', ['message'=>$_SESSION['message'] ?? null], ['user'=>$_SESSION['user']]);
    }
}
