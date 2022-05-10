<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Mail;
use Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showForgetPasswordForm()
    {
        return view('reset.resetEmail');
    }

    /**
     * Write code on Method
     *
     * @return \Illuminate\Http\RedirectResponse()
     */
    public function submitForgetPasswordForm(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users',
            ]);

            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            Mail::send('reset.email.forgetPassword', ['token' => 'token='.$token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });

            notify()->success('We have e-mailed your password reset link!');
            return back();
        }catch (\Exception $e){
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }

    }
    /**
     * Write code on Method
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     */
    public function showResetPasswordForm($token) {
        return view('reset.forgetPasswordLink', ['token' => $token]);
    }

    /**
     * Write code on Method
     *
     * @return \Illuminate\Http\RedirectResponse()
     */
    public function submitResetPasswordForm(Request $request)
    {
        try {
            $request->validate([
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required'
            ]);

            $updatePassword = DB::table('password_resets')
                ->where([
                    'token' => $request->token
                ])
                ->first();

            if(!$updatePassword){
                return back()->withInput()->with('error', 'Invalid token!');
            }

            $user = User::where('email', $updatePassword->email)
                ->update(['password' => Hash::make($request->password)]);

            DB::table('password_resets')->where(['email'=> $updatePassword->email])->delete();

            notify()->success('Your password has been changed!');
            return redirect('/#login');
        }catch (\Exception $e){
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }

    }
}
