<?php

namespace App\Exports;

use App\Models\AppModelsInscriptionPelerinage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class ListeInscritsExport implements FromView
{
    protected $listeInscrits;

    public function __construct($listeInscrits)
    {
        $this->listeInscrits = $listeInscrits;
    }

    public function view(): View
    {
        return view('livewire.pelerinage.liste-inscrits', [
            'listeInscrits' => $this->listeInscrits
        ]);
    }
}
