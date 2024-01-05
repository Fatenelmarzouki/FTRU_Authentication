<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function handleRegister(RegisterRequest $request){
        $user = User::create([
            'name' => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);
            session()->put("user", $user);
            $this->sendOTP($user);
            return redirect()->route('verfiy email');
    }
    public function Callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();
        if(User::where('email',$socialUser->getEmail())->exists()){
            return redirect(route('Login'))->withErrors(['email'=>'This email uses different method to login ']);
        }
        $user = User::where([
            'provider_id' => $socialUser->id,
            'provider_name' => $provider,
        ])->first();
        if (!$user) {
            $user=User::create([
            'name' => $socialUser->getName(),
            'email' => $socialUser->getEmail(),
            'provider_id' => $socialUser->getId(),
            'provider_name' => $provider,
            'provider_token' => $socialUser->token,
            'password' => Hash::make($socialUser->password),
            ]);
        }
        Auth::login($user);
        return view('pages.intro.intro');
    }
    public function handleLogin(Request $request){
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');
        if (Auth::attempt($credentials, $remember)) {
            $user = User::where("email", $request->email)->first();
            session()->put("user", $user);
            return redirect()->route('home');
        }else{
            return redirect()->route('error')->withErrors("Wrong credentials invalid email or password");
        }
    }
    public function sendOTP($user)
    {
        $otp = rand(1000000, 9999999);
        $time = time();
        $user_otp = Otp::updateOrCreate(
            ["email" => $user->email],
            [
                "email" => $user->email,
                "otp" => $otp,
                "created_at" => $time,
            ]
        );
        $data["email"] = $user_otp->email;
        $data["otp"] = $user_otp->otp;
        Mail::send('pages.emails.verfiy', ['data' => $data], function ($message) use ($data) {
            $message->to($data["email"]);
            $message->subject('Verification Email');
        });
    }
    public function handleOTP(Request $request)
    {
        $data = $request->validate([
            'otp' => 'required|numeric',
        ]);
        $user_data = User::where("id", decrypt($request->user_id))->first();
        $otp_data = Otp::where("email", $user_data->email)->first();
        if ($user_data->email == $otp_data->email && $otp_data->otp == $request->otp) {
            $user_data->update([
                // "email_verified_at" => Carbon::now()->timestamp,
                "email_verified_at" => time(),
            ]);
            return redirect()->route('home');
        }else{
            return redirect()->route('verfiy email')->withErrors('Wrong Data,Click on Resend email to send another OTP');
        }
    }
    public function resendOTP()
    {
        if (session()->has("user")) {
            $user = session()->get("user");
            $this->sendOTP($user);
            session()->flash("success", "we send a new email for you, cheack your email");
            return redirect()->route('verfiy email')->with('success', "We send a new email for you, cheack your email");
        } else {
            return redirect()->route('Signup')->withErrors("You don't in our coummunity yet, Please register first");
        }
    }
    public function logout()
    {
        $user = Auth::user();
        Auth::logout();
        if ($user) {
            $user->setRememberToken(null);
            $user->save();
        }
        return redirect()->route('Login');
    }


}