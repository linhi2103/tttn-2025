<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiVatTu;
use App\Models\VatTu;

class HomeController extends Controller
{
    public function index()
    {
        $loaivattus = LoaiVatTu::all();

        return view('index',[
            'loaivattus' => $loaivattus,
        ]);
    }
    public function show($MaVatTu)
    {
        $vatTu = VatTu::findOrFail($MaVatTu);
        return view('livewire.chitietvattu', compact('vatTu'));
    }

}
