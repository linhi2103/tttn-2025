<?php

namespace App\Http\Controllers;

use App\Models\VatTu;
use App\Models\LoaiVatTu;
use App\Models\ChiTietVatTu;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index($MaVatTu)
    {
        $vatTu = VatTu::where('MaVatTu', $MaVatTu)
        ->with('loaivattu')
        ->with('chitietvattu')
        ->first();
        if($vatTu == null){
            return view('errors.404', [
                'message' => 'Sản phẩm không tồn tại'
            ]);
        }else{
            return view('detail', [
                    'vatTu' => $vatTu,
                ]);
        }
    }
}
