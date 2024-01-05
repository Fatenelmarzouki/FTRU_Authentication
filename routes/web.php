<?php

use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('FTRU',[RedirectController::class,'welcome'])->name('FTRU');
Route::get('FTRU/home',[RedirectController::class,'intro'])->name('home')->middleware(['auth','user_verify']);
//Register
Route::get('FTRU/signup', [RedirectController::class,'register'])->name('Signup');
Route::post('FTRU/signup', [UserController::class,'handleRegister'])->name('new user');
//login
Route::get('FTRU/signin', [RedirectController::class,'login'])->name('Login');
Route::post('FTRU/signin', [UserController::class,'handleLogin'])->name('access user');
//login with google
Route::get('auth/{provider}/redirect', [RedirectController::class, 'redirect']);
Route::get('auth/{provider}/callback', [UserController::class, 'Callback']);
//logout
Route::post('FTRU/logout', [UserController::class,'logout'])->name('logout');
//forget password & reset password
Route::get('FTRU/signin/forgetpassword',[ForgetPasswordController::class,'forgetPassword'])->name('forget_pass');
Route::post('FTRU/signin/forgetpassword',[ForgetPasswordController::class,'forgetPasswordHandle'])->name('forget_password_handle');

Route::get("FTRU/reset/{token}",[ForgetPasswordController::class,"resetPassword"])->name("reset_pass");
Route::post("FTRU/reset",[ForgetPasswordController::class, "resetPasswordHandle"])->name("reset_password_handle");
//otp
Route::get('FTRU/verfiy the email',[RedirectController::class,'otpForm'])->name('verfiy email');
Route::post("FTRU/verfiy handle", [UserController::class, "handleOTP"])->name("verfiy handle");
Route::get('FTRU/resend OTP',[UserController::class, 'resendOTP'])->name('resend')->middleware(['throttle:send_email']);
//Wrong route
Route::get("FTRU/Wrong Route", [RedirectController::class, "handleWrongRoute"])->name("wrong_route");
Route::get("FTRU/error", [RedirectController::class, "errors"])->name("error");

Route::fallback(function () {
    return redirect()->route('wrong_route')->withErrors("Oops! It seems like you've reached an incorrect destination");
});