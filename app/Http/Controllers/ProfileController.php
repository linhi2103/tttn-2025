<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NguoiDung;
use App\Models\NhanVien;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = NguoiDung::with('nhanvien')->where('TaiKhoan', Auth::user()->TaiKhoan)->first();
        if(!$user){
            return redirect()->back();
        }
        return view('profile',
            [
                'user' => $user,
            ]
        );
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'phone' => 'required|digits_between:9,15',
                'location' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', 'Cập nhật thông tin thất bại: ' . $e->getMessage());
            return redirect()->back();
        }


        $nhanvien = NhanVien::where('MaNhanVien', Auth::user()->MaNhanVien)->first();
        if ($nhanvien) {
            try{
                if ($request->hasFile('avatar')) {
                    $file = $request->file('avatar');
                    $filename = $nhanvien->MaNhanVien . '.jpg';
                    $file->move(public_path('images/nhanvien'), $filename);
                    $request->merge(['avatar' => 'images/nhanvien/' . $filename]);
                } else {
                    $request->merge(['avatar' => $nhanvien->Anh]);
                }

                $nhanvien->update([
                    'Anh' => $request->input('avatar'),
                    'SDT' => $request->input('phone'),
                    'DiaChi' => $request->input('location'),
                ]);

                $nguoidung = NguoiDung::where('MaNhanVien', Auth::user()->MaNhanVien)->first();
                $nguoidung->update([
                    'Email' => $request->input('email'),
                ]);
                
                session()->flash('success', 'Cập nhật thông tin thành công');
                return redirect()->back();
            }catch (\Exception $e) {
                session()->flash('error', 'Cập nhật thông tin thất bại: ' . $e->getMessage());
                return redirect()->back();
            } 
        }
    }
}
