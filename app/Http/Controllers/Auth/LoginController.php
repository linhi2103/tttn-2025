<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\NguoiDung;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        $remember = $request->has('remember');//có muốn nhớ ko
        $field = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'Email' : 'TaiKhoan';

        $user = NguoiDung::where($field, $credentials['username'])->first();

        if(!$user){
            session()->flash('error', 'Tài khoản không tồn tại');
            return redirect()->back();
        }
        //sosanh pass_nhap với pass_đã mã hóa
        if(!Hash::check($credentials['password'], $user->MatKhau)){
            session()->flash('error', 'Sai tài khoản hoặc mật khẩu');
            return redirect()->back();
        }
        Auth::login($user, $remember);// đ_nhap lâu hon

        return redirect()->intended(route('dashboard'));
    }
}
