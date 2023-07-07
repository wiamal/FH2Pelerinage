<?php

namespace App\Http\Livewire;

use Livewire\Component;

class GenerateCard extends Component
{
    public $checkedAffiliation = [] ; 
    public function render()
    {
        return view('livewire.generate-card');
    }

    public function updated (){
        return view('livewire.generate-card');
    }
}
