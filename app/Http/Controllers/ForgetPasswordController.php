<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ForgetPasswordController extends Controller
{
    public function forgetPassword(){
        return view('pages.forms.forget_password');
    }
    public function forgetPasswordHandle(ForgetPasswordRequest $request){
        $user_email=DB::table('password_reset_tokens')->where('email', $request->email)->first();
        $token = Str::random(64);
        if($user_email == null){
            $user = DB::table('password_reset_tokens')->insert([
                "email"=>$request->email,
                "token"=>$token,
            ]);
        }else{
            $user = DB::table('password_reset_tokens')->where('email', $request->email)->update([
                "email"=>$request->email,
                "token"=>$token,
            ]);
        }
            Mail::send('pages.emails.reset_password', ['token'=>$token], function ($message)use($request) {
                $message->to($request->email, $request->name);
                $message->subject('Reset Your Password');
            });
            return view('pages.emails.check_email');
    }


    public function resetPassword($token){
        $toke=DB::table('password_reset_tokens')->where([
            'token' => $token
        ])->first();
        if($toke){
            return view('pages.forms.reset_password',compact(['token']));
        }else{
            return view('pages.forms.forget_password');
        }
    }


    public function resetPasswordHandle(ResetPasswordRequest $request){
            $reset_pass=DB::table('password_reset_tokens')->where([
                'email'=>$request->email,
                'token'=>$request->token
            ])->first();
            if (!$reset_pass) {
            //handle the error
                return redirect()->route('forget_pass')->with('error', 'Unfortunately, The password reset process could not be completed due to an issue,Try Again.');
            }else{
                User::where('email',$request->email)->update([
                    'password'=>Hash::make($request->password)
                ]);
                DB::table('password_reset_tokens')->where(['email'=>$request->email])->delete();
                return redirect()->route('Login')->with('success',"Password Reset Successfuly,Don't Forget your password again");
            }
    }


}