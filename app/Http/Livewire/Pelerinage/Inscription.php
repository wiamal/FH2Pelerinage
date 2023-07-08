<?php

namespace App\Http\Livewire\Pelerinage;

use Livewire\WithFileUploads;
use Carbon\Carbon;
use App\Models\Adherent;
use App\Models\fonction;
use App\Models\retraite;
use App\Models\Pelerinage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\inscriptionpelerinage;
use App\Models\TypeDocumentPelerinage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Inscription extends Component
{
    use WithFileUploads;

    public $pelerinage;
    public $adherent;
    public $estFonctionnaire = false;
    public $errorMessage;
    public $estRetraite = false;
    public $statut;
    public $nom, $prenom, $nomAr, $prenomAr, $ppr, $pension;
    public $age, $wrongAge = false, $correctAge = false;
    public $correctAnciennete = false, $wrongAnciennete = false;
    public $dateNaissance, $dateRecrutement;
    public $shouldRetire = false;
    public $currentStep = 1;
    public $displayDateRetraite, $dateRetraite;
    public $anciennete;

    // Liste documents
    public $listeDocuments;


    public function render()
    {
        return view('livewire.pelerinage.inscription');
    }

    public function mount()
    {
        $this->pelerinage = Pelerinage::latest()->first();
        $user = Auth::user();
        $idAdherent = $user->IdAdherent;
        $this->listeDocuments = TypeDocumentPelerinage::all();

        if ($idAdherent) {
            $this->adherent = Adherent::where('id_adh', $idAdherent)->first();

            $this->nom = $this->adherent->Nom . ' ' . $this->adherent->Prenom;
            $this->nomAr = $this->adherent->NomAr . ' ' . $this->adherent->PrenomAr;
            $this->estRetraite = $this->isRetraite($this->adherent);
            if (!$this->estRetraite)
                $this->estFonctionnaire = $this->isFonctionnaire($this->adherent);
            if (!$this->estFonctionnaire) {
                $this->statut = 'Unknown';
            }


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

    public function updatedDateNaissance($value)
    {

        if ($value) {
            $age = \Carbon\Carbon::parse($value)->age;

            if ($age >= 63 && $age <= 100)
                $this->shouldRetire = true;
            else
                $this->shouldRetire = false;
            $dhuAlHijjah9 = \Carbon\Carbon::createFromFormat('Y-m-d', $this->pelerinage->DhuAlHijjah9);
            $this->age = $dhuAlHijjah9->diffInYears(\Carbon\Carbon::parse($value));
            if ($this->age < 50 && $this->age >= 18) {
                $this->wrongAge = true;
                $this->correctAge = false;
            } elseif ($this->age > 50 && $this->age <= 100) {
                $this->correctAge = true;
                $this->wrongAge = false;
            }
        }
    }

    public function updatedDateRecrutement($value)
    {
        if ($this->statut == 'R')
            $this->anciennete = \Carbon\Carbon::parse($this->dateRetraite)->diffInYears(\Carbon\Carbon::parse($value));
        else {
            $dhuAlHijjah9 = \Carbon\Carbon::createFromFormat('Y-m-d', $this->pelerinage->DhuAlHijjah9);
            $this->anciennete = $dhuAlHijjah9->diffInYears(\Carbon\Carbon::parse($value));
        }
        if ($this->anciennete >= 10 && $this->anciennete < 50) {
            $this->correctAnciennete = true;
            $this->wrongAnciennete = false;
        } elseif ($this->anciennete < 10 || $this->anciennete >= 50) {
            $this->correctAnciennete = false;
            $this->wrongAnciennete = true;
        }
    }

    public function updatedStatut($value)
    {
        // dd($value);
        if ($value == 'R')
            $this->displayDateRetraite = true;
        else if ($value == 'F')
            $this->displayDateRetraite = false;
    }

    public function isFonctionnaire($adherent)
    {
        if ($adherent->PPR) {
            $this->ppr = $adherent->PPR;
            $this->statut = 'F';
            return true;
        } else {
            return false;
        }
    }

    public function isRetraite($adherent)
    {
        if ($adherent->Pension_Retraite != null) {
            $this->pension = $adherent->Pension_Retraite;
            $this->statut = 'R';
            return true;
        } else {
            return false;
        }
    }

    public function nextStep()
    {
        if (++$this->currentStep > 2)
            $this->currentStep = 2;
    }
    public function previousStep()
    {
        if (--$this->currentStep < 1)
            $this->currentStep = 1;
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
                'dateNaissance' => [
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
                        $dateNaissance = $r->input('dateNaissance');
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
                'dateNaissance.required' => 'La date de naissance est obligatoire.',
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
        $inscription->dateNaissance = $r->input('dateNaissance');
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
