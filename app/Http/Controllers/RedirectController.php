<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class RedirectController extends Controller
{
    public function welcome()
    {
        return view('index');
    }
    public function register()
    {
        return view('register');
    }
    public function login()
    {
        return view('login');
    }
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function intro(){
        return view('pages.intro.intro');
    }
    public function otpForm(){
        return view('pages.forms.otp');
    }
    public function handleWrongRoute()
    {
        return view('pages.errors.wrong_route');
    }
    public function errors()
    {
        return view('pages.errors.confirmed');
    }
}