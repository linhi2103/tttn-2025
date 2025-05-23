<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Activitylog\Models\Activity as ActivityLog;
use App\Models\NguoiDung;

class LichSuThayDoi extends Component
{
    public function render()
    {
        $nguoidungs = NguoiDung::all();
        $lichsuthaydois = ActivityLog::paginate(10);
        return view('livewire.lich-su-thay-doi',[
            'lichsuthaydois' => $lichsuthaydois,
            'nguoidungs' => $nguoidungs,
        ]);
    }
}
