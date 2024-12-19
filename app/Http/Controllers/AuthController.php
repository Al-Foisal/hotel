<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function makeAuth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1
        ])) {
            $auth = auth()->user();
            session()->put('auth', $auth);
            session()->put('auth_id', $auth->id);
            session()->put('owner_id', $auth->owner_id);
            return to_route('welcome');
        }

        return to_route('login')->withToastError('Invalid credentials');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }
    public function storeForgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }


        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withToastError('This email is no longer with our records!!');
        }

        $url = route('resetPassword', [$request->_token, 'email' => $request->email]);

        Mail::to($request->email)->send(new ResetPassword($url));

        DB::table('password_reset_tokens')->insert([
            'token'      => $request->_token,
            'email'      => $request->email,
            'created_at' => now(),
        ]);

        return redirect()->back()->withToastSuccess('We have sent a fresh reset password link to your email.');
    }

    public function resetPassword(Request $request)
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    public function storeResetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->with('errors', $validator->messages()->all()[0])->withInput();
        }

        $password = DB::table('password_reset_tokens')->where('email', $request->email)->where('token', $request->token)->first();

        if (!$password) {
            return redirect()->back()->with('Something went wrong, Invalid token or email!!');
        }

        $user = User::where('email', $request->email)->first();

        if ($user && $password) {
            $user->update(['password' => bcrypt($request->password)]);

            $password = DB::table('password_reset_tokens')->where('email', $request->email)->delete();

            return to_route('login')->withToastSuccess('New password reset successfully!!');
        } else {
            return redirect()->back()->with('The email is no longer our record!!');
        }
    }
}
