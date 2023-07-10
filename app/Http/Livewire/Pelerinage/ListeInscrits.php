<?php

namespace App\Http\Livewire\Pelerinage;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ListeInscritsExport;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


use Livewire\Component;

class ListeInscrits extends Component
{
    public $listeInscrits;
    public $listeInscritsActif = [], $listeInscritsLocalError = [], $listeInscritsExternalError = [];
    public $annee;
    public $retraite;

    public function render()
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
        // ON `users-pelerinage`.IdAdherent = inscriptionpelerinage.IdAdherent
        // INNER JOIN statutinscriptionpelerinage
        // ON inscriptionpelerinage.IdStatutInscriptionPelerinage=statutinscriptionpelerinage.IdStatutInscriptionPelerinage;
        $this->listeInscrits = DB::table('inscriptionpelerinage')
            ->select(
                DB::raw("inscriptionpelerinage.IdInscription, pelerinage23.Annee, ab6.Affiliation, ab6.Nom, ab6.Prenom, 
                ab6.NomAr, ab6.PrenomAr, ab6.pid, ab6.CIN, ab6.PPR, ab6.Pension_Retraite, ab6.Situation_Famille, ab6.grade, 
                ab6.Date_Affectation, ab6.GSM, ab6.Fixe, `users-pelerinage`.email,ab6.Date_Naissance")
            )
            ->join('ab6', 'ab6.id_adh', 'inscriptionpelerinage.IdAdherent')
            ->join('pelerinage23', 'pelerinage23.IdPelerinage', 'inscriptionpelerinage.IdPelerinage')
            ->join('users-pelerinage', 'users-pelerinage.IdAdherent', 'inscriptionpelerinage.IdAdherent')
            ->join('statutinscriptionpelerinage', 'IdStatutInscriptionPelerinage', 'IdStatutInscriptionPelerinage')
            ->get();
        foreach ($this->listeInscrits as $insc) {
            $this->annee = $insc->Annee;
            $this->retraite = $insc->Pension_Retraite == null ? false : true;
            break;
        }

        foreach ($this->listeInscrits as $insc) {
            if ($insc->IdStatutInscriptionPelerinage == 2)
                array_push($this->listeInscritsActif, $insc);
        }

        return view('livewire.pelerinage.liste-inscrits');
    }


    public function exportToExcel()
    {
        // Créez un nouvel objet Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Sélectionnez la feuille active
        $sheet = $spreadsheet->getActiveSheet();
        // Ajouter les en-têtes de colonne
        $headers = [
            'ID Inscription',
            'Affiliation',
            'Nom & prénom',
            'الإسم والنسب',
            'Sexe',
            'Date de naissance',
            'Age',
            'Situation familiale',
            'CIN',
            'Retraite',
            'PPR',
            'Pension',
            'Grade',
            'Tel',
            'Fixe',
            'Email'
        ];

        // Bouclez sur les en-têtes de colonne
        foreach ($headers as $index => $header) {
            // Convertissez l'index en lettre de colonne correspondante (A, B, C, etc.)
            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($index + 1);

            // Ajoutez l'en-tête à la cellule correspondante de la première ligne
            $sheet->setCellValue($columnLetter . '1', $header);
        }

        // Définir le titre de la feuille Excel
        $sheet->setTitle('Liste des inscrits');

        // Définir la première colonne (A) pour la première ligne
        $currentColumn = 'A';

        // Bouclez sur les résultats et ajoutez-les à la feuille Excel
        foreach ($this->listeInscrits as $index => $row) {
            // Index commence à 0, donc nous ajoutons 1 pour correspondre à la première ligne de la feuille Excel
            $rowNumber = $index + 1;

            // Réinitialiser la colonne à chaque nouvelle ligne
            $currentColumn = 'A';

            // Bouclez sur les colonnes de chaque ligne
            foreach ($row as $value) {
                // Ajoutez la valeur à la cellule correspondante de la feuille Excel
                $sheet->setCellValue($currentColumn . $rowNumber, $value);

                // Avancez à la colonne suivante
                $currentColumn++;
            }
        }

        // Créez un objet Writer pour générer le fichier Excel
        $writer = new Xlsx($spreadsheet);

        // Spécifiez le nom du fichier Excel à exporter
        $filename = 'ListeInscrits-pelerinage-' . $this->annee . '.xlsx';

        // Enregistrez le fichier Excel
        $writer->save($filename);

        // Téléchargez le fichier Excel
        return response()->download($filename)->deleteFileAfterSend();
    }
}
