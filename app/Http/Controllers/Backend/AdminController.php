<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\VerifyCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $verificationCode = random_int(100000, 999999);

            session(['verification_code' => $verificationCode, 'user_id' => $user->id]);

            Mail::to($user->email)->send(new VerifyCodeMail($verificationCode));

            Auth::logout();

            return redirect()->route('custom.verification.form')
                ->with('status', 'Verification Code sent to you email.');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials provided.']);
    }

    public function showVerification()
    {
        return view('auth.verify');
    }

    public function verifyCode(Request $request)
    {
        $request->validate(['code' => ['required', 'numeric']]);

        $code = (int) $request->code;
        $sessionCode = session('verification_code');

        if ((int) $request->code === session('verification_code')) {
            Auth::loginUsingId(session('user_id'));

            session()->forget([
                'verification_code',
                'user_id'
            ]);

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['code' => 'Invalid Verification Code.']);
    }
}
