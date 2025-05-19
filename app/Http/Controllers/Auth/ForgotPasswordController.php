<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\NguoiDung;
use App\Models\PasswordResetTokens;
use App\Mail\PasswordResetNotification;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }   

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = NguoiDung::where('Email', $request->email)->first();

        if (!$user) {
            session()->flash('error', 'Email không tồn tại');
            return redirect()->back();     
        }

        $token = Str::random(60);
        PasswordResetTokens::create([
            'email' => $user->Email,
            'token' => $token,
            'created_at' => now(),
        ]);

        Mail::to($user->Email)->send(new PasswordResetNotification($token,$user->TaiKhoan));
        
        session()->flash('success', 'Mã xác nhận đã được gửi đến email của bạn');

        return redirect()->route('forgot-password');
    }

    public function resetPassword($token)
    {
        return view('auth.reset-password', compact('token'));
    }

    public function resetPasswordSubmit(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|string|confirmed',
        ]);
        $prt = PasswordResetTokens::where('token', $request->token)->first();
        $user = NguoiDung::where('Email', $prt->email)->first();

        if (!$user) {
            session()->flash('error', 'Email không tồn tại');
            return redirect()->back();
        }

        $user->update([
            'MatKhau' => Hash::make($request->password),
        ]);

        PasswordResetTokens::where('email', $prt->email)->delete();
        session()->flash('success', 'Mật khẩu đã được thay đổi');

        return redirect()->route('login');
    }
}
