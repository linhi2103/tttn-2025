<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiVatTu;

class HomeController extends Controller
{
    public function index()
    {
        $DanhSachLoaiVatTu = LoaiVatTu::all();
        return view('index',[
            'DanhSachLoaiVatTu' => $DanhSachLoaiVatTu
        ]);
    }
}
