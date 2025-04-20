<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LoaiVatTu;
use App\Models\VatTu;
use Livewire\WithPagination;

class Container extends Component
{
    use WithPagination;
    public $activeComponent = 'dashboard';
    public $MaLoaiVatTu;

    public function render()
    {
        $loaivattus = LoaiVatTu::all();
        return view('livewire.container', [
            'loaivattus' => $loaivattus,
        ]);
    }
    
    public function setActiveComponent($component, $filter = null)
    {
        $this->activeComponent = $component;
        $this->MaLoaiVatTu = $filter;
    }
}
