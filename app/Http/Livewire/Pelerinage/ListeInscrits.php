<?php

namespace App\Http\Livewire\Pelerinage;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListeInscrits extends Component
{
    public $listeInscrits;
    public $annee;
    public $retraite;

    public function mount()
    {
        // SELECT inscriptionpelerinage.IdInscription, pelerinage23.Annee, ab6.Affiliation, ab6.Nom, ab6.Prenom, ab6.NomAr, ab6.PrenomAr, ab6.pid,
        // ab6.CIN, ab6.PPR, ab6.Pension_Retraite, ab6.Situation_Famille, ab6.grade, ab6.Date_Affectation,
        // ab6.GSM, ab6.Fixe, `users-pelerinage`.email
        // FROM inscriptionpelerinage
        // INNER JOIN ab6
        // ON ab6.id_adh = inscriptionpelerinage.IdAdherent
        // INNER JOIN pelerinage23
        // ON pelerinage23.IdPelerinage = inscriptionpelerinage.IdPelerinage
        // INNER JOIN `users-pelerinage`
        // ON `users-pelerinage`.IdAdherent = inscriptionpelerinage.IdAdherent;
        $this->listeInscrits = DB::table('inscriptionpelerinage')
            ->select(
                DB::raw("inscriptionpelerinage.IdInscription, pelerinage23.Annee, ab6.Affiliation, ab6.Nom, ab6.Prenom, 
                ab6.NomAr, ab6.PrenomAr, ab6.pid, ab6.CIN, ab6.PPR, ab6.Pension_Retraite, ab6.Situation_Famille, ab6.grade, 
                ab6.Date_Affectation, ab6.GSM, ab6.Fixe, `users-pelerinage`.email,ab6.Date_Naissance")
            )
            ->join('ab6', 'ab6.id_adh', 'inscriptionpelerinage.IdAdherent')
            ->join('pelerinage23', 'pelerinage23.IdPelerinage', 'inscriptionpelerinage.IdPelerinage')
            ->join('users-pelerinage', 'users-pelerinage.IdAdherent', 'inscriptionpelerinage.IdAdherent')
            ->get();
        foreach ($this->listeInscrits as $insc) {
            $this->annee = $insc->Annee;
            $this->retraite = $insc->Pension_Retraite == null ? false : true;
            break;
        }
    }
    public function render()
    {
        return view('livewire.pelerinage.liste-inscrits');
    }
}
