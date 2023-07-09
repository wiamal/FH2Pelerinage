<?php

namespace App\Http\Livewire\Pelerinage;

use Livewire\WithFileUploads;
use Carbon\Carbon;
use App\Models\Adherent;
use App\Models\fonction;
use App\Models\retraite;
use App\Models\Pelerinage;
use App\Models\TypeDocumentPelerinage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\inscriptionpelerinage;
use App\Models\InscriptionPelerinage as ModelsInscriptionPelerinage;
use App\Models\PelerinageFile;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


use Livewire\Component;

class Inscription extends Component
{
    use WithFileUploads;

    // protected $listeners = ['documentUpdated'];

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
    public $dejaBeneficiant;
    public $selectedTypeDocument;
    public $hasAccount = false;

    // Liste documents
    public $demande, $facture, $certificat, $declaration, $visa, $rib;
    public $demandeBD, $factureBD, $certificatBD, $declarationBD, $visaBD, $ribBD;

    public $listeDocuments, $tmplisteDocuments = [];
    public $filename;
    public $path;

    //Existing account
    public $idInscription;

    protected $rules = [
        'dateNaissance' => 'required|date|before:today',
        'dateRecrutement' => 'required|date|after:dateNaissance|before_or_equal:today',
        'dejaBeneficiant' => 'required|accepted',
        'dateRetraite' => 'nullable|required_if:statut,R|date|after:dateRecrutement',
        'statut' => 'required|in:R,F',
    ];

    protected $messages = [
        'dejaBeneficiant' => 'Vous ne devez pas avoir déjà bénéficié du pèlerinage.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.pelerinage.inscription');
    }

    public function mount()
    {
        $this->pelerinage = Pelerinage::latest()->first();
        $user = Auth::user();
        $idAdherent = $user->IdAdherent;
        $result = InscriptionPelerinage::where('IdAdherent', $idAdherent)->first();
        if (!empty($result)) {
            $this->hasAccount = true;
            $this->idInscription = $result->IdInscription;
            $this->dateNaissance = $result->DateNaissance;
            $this->dateRecrutement = $result->DateRecrutement;
            if ($result->Retraite == 1) {
                $this->dateRetraite = $result->DateRetraite;
            }
            $existing_files = PelerinageFile::where('IdInscription', $this->idInscription)->orderBy('IdTypeDocument')->get();
            //dd($existing_files);

            foreach ($existing_files as $file) {
                //dd($file->URLL);
                if ($file->IdTypeDocument == 1) {
                    $this->demandeBD = $file->URL;
                } elseif ($file->IdTypeDocument == 2) {
                    $this->factureBD = $file->URL;
                } elseif ($file->IdTypeDocument == 3) {
                    $this->certificatBD = $file->URL;
                } elseif ($file->IdTypeDocument == 4) {
                    $this->declarationBD = $file->URL;
                } elseif ($file->IdTypeDocument == 5) {
                    $this->visaBD = $file->URL;
                } elseif ($file->IdTypeDocument == 6) {
                    $this->ribBD = $file->URL;
                }
            }
            // dd($this->certificatBD);
        }
        //$this->listeDocuments = TypeDocumentPelerinage::all();

        if ($idAdherent) {
            $this->adherent = Adherent::where('id_adh', $idAdherent)->first();

            $this->nom = $this->adherent->Nom . ' ' . $this->adherent->Prenom;
            $this->nomAr = $this->adherent->NomAr . ' ' . $this->adherent->PrenomAr;
            $this->estRetraite = $this->isRetraite($this->adherent);
            if (!$this->estRetraite) {
                $this->estFonctionnaire = $this->isFonctionnaire($this->adherent);
                if (!$this->estFonctionnaire) {
                    $this->statut = 'Unknown';
                }
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

    // public function documentUpdated($value, $id)
    // {
    // }

    public function updatedDateNaissance($value)
    {

        if ($value) {
            $age = Carbon::parse($value)->age;

            if ($age >= 63 && $age <= 100)
                $this->shouldRetire = true;
            else
                $this->shouldRetire = false;
            $dhuAlHijjah9 = Carbon::createFromFormat('Y-m-d', $this->pelerinage->DhuAlHijjah);
            $this->age = $dhuAlHijjah9->diffInYears(Carbon::parse($value));
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
            $dhuAlHijjah9 = \Carbon\Carbon::createFromFormat('Y-m-d', $this->pelerinage->DhuAlHijjah);
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
        if ($value == 'R') {
            $this->displayDateRetraite = true;
        } elseif ($value == 'F')
            $this->displayDateRetraite = false;
    }

    public function updatedDemande($value)
    {
        $this->addTmpDocument($value, 1);
    }
    public function updatedFacture($value)
    {
        $this->addTmpDocument($value, 2);
    }
    public function updatedCertificat($value)
    {
        $this->addTmpDocument($value, 3);
    }
    public function updatedDeclaration($value)
    {
        $this->addTmpDocument($value, 4);
    }
    public function updatedVisa($value)
    {
        $this->addTmpDocument($value, 5);
    }
    public function updatedRib($value)
    {
        $this->addTmpDocument($value, 6);
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
        $this->validate();
        if (++$this->currentStep > 2)
            $this->currentStep = 2;
    }
    public function previousStep()
    {
        if (--$this->currentStep < 1)
            $this->currentStep = 1;
    }

    public function addTmpDocument($file, $idType)
    {
        $replaced = false;
        foreach ($this->tmplisteDocuments as $doc) {
            if ($doc[1] == $idType) {
                $doc[0] = $file;
                $replaced = true;
            }
        }
        if (!$replaced)
            array_push($this->tmplisteDocuments, [$file, $idType]);
    }

    public function inscrire()
    {
        $this->validate();
        // dd($this->compare());
        DB::beginTransaction();
        try {
            if (!$this->hasAccount) {
                if ($this->correctAge && $this->correctAnciennete && $this->dejaBeneficiant)
                    $id = InscriptionPelerinage::create([
                        'IdAdherent' => $this->adherent->id_adh,
                        'IdPelerinage' => $this->pelerinage->IdPelerinage,
                        'DateNaissance' => $this->dateNaissance,
                        'DateRecrutement' => $this->dateRecrutement,
                        'DateRetraite' => $this->dateRetraite == null ? null : $this->dateRetraite,
                        'Retraite' => $this->dateRetraite == null ? 0 : 1,
                        'IdStatutInscriptionPelerinage' => $this->compare()
                    ])->IdInscription;
                // (`IdFile`, `IdInscription`, `IdTypeDocument`, `URL`, `created_at`, `updated_at`)
                $date = now()->format('Ymd');
                $path = '/pelerinage_' . $this->pelerinage->Annee . '/' . $this->adherent->id_adh . '_' . $date . '/';

                foreach ($this->tmplisteDocuments as $doc) {
                    $document = $doc[0];
                    $ext = pathinfo($document->getClientOriginalName(), PATHINFO_EXTENSION);
                    $filename = ((string) Str::orderedUuid()) . '.' . $ext;
                    $document->storeAs($path, $filename, $disk = 'public');
                    PelerinageFile::create(['IdInscription' => $id, 'IdTypeDocument' => $doc[1], 'URL' => $path . $filename]);
                }
            } else {
                $this->validate();
                $updated = InscriptionPelerinage::where('IdInscription', $this->idInscription)->update([
                    'DateNaissance' => $this->dateNaissance,
                    'DateRecrutement' => $this->dateRecrutement,
                    'DateRetraite' => $this->statut == 'R' ? $this->dateRetraite : null,
                    'Retraite' => $this->statut == 'R' ? 1 : 0,
                    'IdStatutInscriptionPelerinage' => $this->compare()
                ]);

                $date = now()->format('Ymd');
                $path = '/pelerinage_' . $this->pelerinage->Annee . '/' . $this->adherent->id_adh . '_' . $date . '/';

                $existing_files = PelerinageFile::where('IdInscription', $this->idInscription)->get();
                if ($existing_files != null && $existing_files->isNotEmpty()) {
                    foreach ($existing_files as $file) {
                        foreach ($this->tmplisteDocuments as $index => $doc) {
                            if ($file->IdTypeDocument == $doc[1]) {
                                Storage::disk('public')->delete($file->URL);
                                $document = $doc[0];
                                $ext = pathinfo($document->getClientOriginalName(), PATHINFO_EXTENSION);
                                $filename = ((string) Str::orderedUuid()) . '.' . $ext;
                                $document->storeAs($path, $filename, $disk = 'public');
                                PelerinageFile::where('IdFile', $file->IdFile)->update(['URL' => $path . $filename]);
                                unset($this->tmplisteDocuments[$index]);
                            }
                        }
                    }
                }
                foreach ($this->tmplisteDocuments as $doc) {
                    $document = $doc[0];
                    $ext = pathinfo($document->getClientOriginalName(), PATHINFO_EXTENSION);
                    $filename = ((string) Str::orderedUuid()) . '.' . $ext;
                    $document->storeAs($path, $filename, $disk = 'public');
                    PelerinageFile::create(['IdInscription' => $this->idInscription, 'IdTypeDocument' => $doc[1], 'URL' => $path . $filename]);
                }
            }
            DB::commit();
            $this->hasAccount = true;
            if (!$this->hasAccount)
                session()->flash('success', "Demande enregistree avec succes.");
            // return back()->with('success', "Demande enregistree avec succes.");
            else
                // return back()->with('success', "Modifications apportees avec succes.");
                session()->flash('success', "Modifications apportees avec succes.");
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
            return back()->with('error', "Un problème est survenue lors de l'inscription de l'adhérent au programme du pelerinage");
        }
    }

    public function compare()
    {
        // `Date_Affectation``Date_Retraite``Date_Naissance`
        if ($this->statut == 'F' || $this->statut == 'R') {
            $value = Adherent::where('id_adh', $this->adherent->id_adh)->first()->Date_Naissance;
            if (Carbon::parse($value) != Carbon::parse($this->dateNaissance)) {
                return 4;
            }
            $value = Adherent::where('id_adh', $this->adherent->id_adh)->first()->Date_Affectation;
            if (Carbon::parse($value) != Carbon::parse($this->dateRecrutement)) {
                return 4;
            }
        }
        if ($this->statut == 'R') {
            if ($this->dateRetraite != null && $this->statut == 'R') {
                $value = Adherent::where('id_adh', $this->adherent->id_adh)->first()->Date_Retraite;
                if (Carbon::parse($value) != Carbon::parse($this->dateRetraite)) {
                    return 4;
                }
            } elseif ($this->dateRetraite != null && $this->statut == 'F') { {
                    return 5;
                }
            }
        }
        if ($this->statut == 'Unknown') { {
                return 5;
            }
        }
        if (count($this->tmplisteDocuments) == 5) {
            return 2;
        } else {
            return 1;
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
