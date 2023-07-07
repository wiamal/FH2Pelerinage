<?php

namespace App\Http\Livewire\Pelerinage;

use Carbon\Carbon;
use App\Models\Adherent;
use App\Models\fonction;
use App\Models\retraite;
use App\Models\Pelerinage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\inscriptionpelerinage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Inscription extends Component
{
    public $pelerinage;
    public $adherent;
    public $estFonctionnaire = false;
    public $errorMessage;
    public $estRetraite = false;
    public $statut;

    public function render()
    {
        return view('livewire.pelerinage.inscription');
    }

    public function mount()
    {
        $this->pelerinage = Pelerinage::latest()->first();
        $user = Auth::user();
        $idAdherent = $user->IdAdherent;

        if ($idAdherent) {
            $this->adherent = Adherent::where('id_adh', $idAdherent)->first();
            $this->estRetraite = $this->isRetraite($this->adherent);
            $this->estFonctionnaire = $this->isFonctionnaire($this->adherent);

            // if ($this->estRetraite) $this->statut = 'R';
            // else {
            //     if ($this->estFonctionnaire) $this->statut = 'F';
            //     else {
            //         $this->statut = 'UR';
            //         $this->errorMessage = "Vous n'avez pas informer la fondation de votre départ à la retraite. Merci de vous présentez à la fondation
            // ou auprès de votre coordonnateur régional afin de régler votre situation administrative";
            //     }
            // }
        }
    }

    public function isFonctionnaire($adherent)
    {
        if ($adherent->PPR) {
            return true;
        } else {
            $this->errorMessage = 'Veuillez regler votre situation administratif';
            return false;
        }
    }

    public function isRetraite($adherent)
    {
        // dd($adherent);
        if ($adherent->Pension_Retraite != null) {
            return true;
        } else {

            return false;
        }
    }

    public function demander(Request $r)
    {
        $user = Auth::user();
        $idAdherent = $user->IdAdherent;
        $pelerinage = Pelerinage::latest()->first();
        $pelerinageYear = $pelerinage->Annee;
        $dateFinDolhijja = $pelerinage->FinDolhijja;
        $pelerinageFolder = "pelerinage_$pelerinageYear";
        $date = now()->format('Ymd');
        $folderName = $pelerinageFolder . '/' . $idAdherent . '_' . $date;
        $fileNames = ['Demande', 'DeclarationHonneurFH2', 'RecuDepenses', 'Visa', 'Passport', 'ReleveDidentiteBanquer', 'AttestationDuPremiereParticipation'];
        $paths = [];

        $validator = Validator::make(
            $r->all(),
            [
                'DateNaissance' => [
                    'required',
                    function ($attribute, $value, $fail) use ($dateFinDolhijja) {
                        // Convert $dateFinDolhijja to a Carbon instance for comparison
                        $dateFinDolhijja = Carbon::parse($dateFinDolhijja);

                        // Convert $value (DateNaissance) to a Carbon instance for comparison
                        $dateNaissance = Carbon::parse($value);

                        // Calculate the difference in years between $dateFinDolhijja and $dateNaissance
                        $differenceInYears = $dateNaissance->diffInYears($dateFinDolhijja);

                        // Check if the calculated difference is greater than 50
                        if ($differenceInYears < 50) {
                            $fail('Vous devez etre age de plus de 50 ans.');
                        }
                    }
                ],
                'DateRecrutement' => [
                    'required',
                    function ($attribute, $value, $fail) use ($r, $idAdherent) {
                        $etatFonction = $r->input('EtatFonction');
                        $dateNaissance = $r->input('DateNaissance');
                        if (strtotime($value) <= strtotime($dateNaissance)) {
                            $fail('La date de recrutement doit être postérieure à la date de naissance.');
                        }
                        if ($etatFonction === 'Fonctionaire') {
                            $dateRecrutement = Carbon::parse($value);
                            $today = Carbon::today();
                            $differenceInYears = $dateRecrutement->diffInYears($today);
                            if ($differenceInYears < 10) {
                                $fail('Vous devez avoir plus de 10 ans d\'anciennete.');
                            }
                        } elseif ($etatFonction === 'Retraite') {
                            $retraite = retraite::where('IdAdherent', $idAdherent)->first();
                            if ($retraite) {
                                $dateRetraite = Carbon::parse($retraite->DateRetraite);
                                $dateRecrutement = Carbon::parse($value);
                                $differenceInYears = $dateRecrutement->diffInYears($dateRetraite);
                                if ($differenceInYears < 10) {
                                    $fail('Vous devez avoir plus de 10 ans d\'anciennete.');
                                }
                            }
                        } elseif ($etatFonction === 'FonctionaireRetraite') {
                            $dateRetraite = Carbon::parse($r->input('DateRetraite'));
                            $dateRecrutement = Carbon::parse($value);
                            $differenceInYears = $dateRecrutement->diffInYears($dateRetraite);
                            if ($differenceInYears < 10) {
                                $fail('Vous devez avoir plus de 10 ans d\'anciennete.');
                            }
                        }
                    }
                ],
                'DateRetraite' => 'required',
                'Pension' => 'required',

                'DejaBeneficierDuPelerinage' => 'required',
                'Demande' => 'required|mimes:pdf|max:2048',
                'DeclarationHonneurFH2' => 'required|mimes:pdf|max:2048',
                'RecuDepenses' => 'required|mimes:pdf,sql|max:2048',
                'Visa' => 'required|mimes:pdf|max:2048',
                'Passport' => 'required|mimes:pdf|max:2048',
                'ReleveDidentiteBanquer' => 'required|mimes:pdf|max:2048',
                'AttestationDuPremiereParticipation' => 'required|mimes:pdf|max:2048'
            ],
            [
                'DateNaissance.required' => 'La date de naissance est obligatoire.',
                'DateRecrutement.required' => 'La date de recrutement est obligatoire.',
                'DateRecrutement.after' => 'La date de recrutement doit être postérieure à la date de naissance.',
                'DejaBeneficierDuPelerinage.required' => 'Vous devriez être bénéficiaire du pèlerinage pour la première fois.',
                'Demande.required' => 'La demande est obligatoire.',
                'Demande.mimes' => 'La demande doit être un fichier PDF.',
                'Demande.max' => 'La demande ne doit pas dépasser 2048 Ko.',
                'DeclarationHonneurFH2.required' => 'La declaration d\'honneur est obligatoire.',
                'DeclarationHonneurFH2.mimes' => 'La declaration d\'honneur doit être un fichier PDF.',
                'DeclarationHonneurFH2.max' => 'La declaration d\'honneur ne doit pas dépasser 2048 Ko.',
                'RecuDepenses.required' => 'Le recu de depenses est obligatoire.',
                'RecuDepenses.mimes' => 'Le recu de depenses  doit être un fichier PDF.',
                'RecuDepenses.max' => 'Le recu de depenses ne doit pas dépasser 2048 Ko.',
                'Visa.required' => 'Visa est obligatoire.',
                'Visa.mimes' => 'Visa  doit être un fichier PDF.',
                'Visa.max' => 'Visa ne doit pas dépasser 2048 Ko.',
                'Passport.required' => 'Passport est obligatoire.',
                'Passport.mimes' => 'Passport  doit être un fichier PDF.',
                'Passport.max' => 'Passport ne doit pas dépasser 2048 Ko.',
                'ReleveDidentiteBanquer.required' => 'Releve d\'identite banquer est obligatoire.',
                'ReleveDidentiteBanquer.mimes' => 'Releve d\'identite banquer  doit être un fichier PDF.',
                'ReleveDidentiteBanquer.max' => 'Releve d\'identite banquer ne doit pas dépasser 2048 Ko.',
                'AttestationDuPremiereParticipation.required' => 'Attestation du premiere participation au pelerinage est obligatoire.',
                'AttestationDuPremiereParticipation.mimes' => 'Attestation du premiere participation au pelerinage  doit être un fichier PDF.',
                'AttestationDuPremiereParticipation.max' => 'Attestation du premiere participation au pelerinage ne doit pas dépasser 2048 Ko.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        foreach ($fileNames as $fileName) {
            $file = $r->file($fileName);
            $name = $idAdherent . '_' . $fileName;
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $name . '.' . $extension;
            $paths[$fileName] = $file->storeAs('public/' . $folderName, $fileNameToStore);
        }









        $inscription = new inscriptionpelerinage();
        $inscription->IdAdherent = $idAdherent;
        $inscription->IdPelerinage = $pelerinage->IdPelerinage;
        $inscription->DateNaissance = $r->input('DateNaissance');
        $inscription->DateRecrutement = $r->input('DateRecrutement');
        $inscription->EtatFonction = $r->input('EtatFonction');
        $inscription->DejaBeneficier = $r->input('DejaBeneficierDuPelerinage') ? 0 : 1;
        $inscription->DemandeFH2 = $paths['Demande'];
        $inscription->DeclaratioHonneurFH2 = $paths['DeclarationHonneurFH2'];
        $inscription->RecuDepenses = $paths['RecuDepenses'];
        $inscription->Pelerinage1Fois = $paths['AttestationDuPremiereParticipation'];
        $inscription->Visa = $paths['Visa'];
        $inscription->Passport = $paths['Passport'];
        $inscription->RIB = $paths['ReleveDidentiteBanquer'];
        $inscription->IdStatutInscriptionPelerinage = 1;
        $inscription->save();

        return redirect()->back()->with('success', 'Data inserted successfully');
    }
}
