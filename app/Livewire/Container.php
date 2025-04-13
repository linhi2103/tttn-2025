<?php

namespace App\Livewire;

use Livewire\Component;

class Container extends Component
{
    public $activeComponent = 'dashboard';
    public function render()
    {
        return view('livewire.container');
    }
    
    public function setActiveComponent($component)
    {
        $this->activeComponent = $component;
    }
}
