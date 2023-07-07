<?php

namespace App\Http\Controllers;

use DateTime;

use App\Models\card;
use App\Models\vueenfant;
use App\Models\vueadherent;
use App\Models\vueconjoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Exportcard extends Controller
{
    //
    /* public function ViewCard($id){
        return view('dashboard.card.card', ['id' => $id]); 
    } */

    public function ViewCard(){
        return view('dashboard.card.card'); 
    }
    public function saveCard(Request $request){

        $allSelectedAffiliations= $request->affiliation; 

        $adherents = [];
        $conjoints = [];
        $enfants = [];
        
        //  filter sur les n° des affiliations 

        for ($i=0 ; $i<count($allSelectedAffiliations);$i++){

            $itemAdh = vueadherent::where('Aff', $allSelectedAffiliations[$i])->get()->toArray();
            $itemCnj = vueconjoint::where('Aff', $allSelectedAffiliations[$i])->get()->toArray(); 
            $itemEnf = vueenfant::where('Aff', $allSelectedAffiliations[$i])->get()->toArray();
          
            
            if (!empty($itemAdh)){
                array_push($adherents, $itemAdh);
            };

            if (!empty($itemCnj)){
                array_push($conjoints, $itemCnj);
            };

            if (!empty($itemEnf)){
                array_push($enfants, $itemEnf);
            };

        };

       // Prepare columns names 

       $columnNames = [
        'Aff',                            //A1
        'Qualité',                        //B1
        'Nom',                            //C1
        'Prenom',                         //D1
        'nomprenomar',                    //E1
        'NomAr',                          //F1
        'PrenomAr',                       //G1
        'CINN',                           //H1
        'CIN',                            //I1
        'PPRR',                           //j1
        'PPR',                            //K1
        'Naissance',                      //L1
        'DateNaissance',                  //M1
        'Photo',                          //N1
        'CINN-CONJOIT',                   //O1
        'CIN-Conjit',                     //P1
        'Adherent',                       //Q1
        'Nom-Adherent',                   //R1
        'Prenom-adherent',                //S1
        'CINN-Adherent',                  //T1
        'CIN-Adhérent',                   //U1
        'PPRR-Adherent',                  //V1
        'PPR-Adherent',                   //w1  
    ];

            $dataAdherentRow =[] ;
            $dataConjointRow =[] ;
            $dataEnfantRow = [] ; 
            $Cells = [] ;
            $alldatarows = [] ; 



            // (A) CREATE WORKSHEET
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle("Impression des Cartes");


            // (B) SET Column's names in the first row of the Table
            $sheet->fromArray($columnNames, null, "A1");

            // (C) SET DATA FROM ARRAY INTO CELLS

            $rowIndex = 2 ; //start row

        if(!empty($adherents)){
        
        for ($i=0 ; $i<count($adherents);$i++){
            
            foreach($adherents[$i] as $key => $value) {
                $dataAdherentRow = $value ;  
            };
            for ($j=0 ; $j<count($columnNames);$j++)
                    {
                        switch ($j) {
                            case 0: //'Aff'
                                $Cells[$j] = 'N°: '.$dataAdherentRow['Aff'] ;
                                break;
                            case 1: //Qualité
                                $Cells[$j] = 'Qualité : '.$dataAdherentRow['Qualité'] ;
                                break;
                            case 2: //nom
                                $Cells[$j] = $dataAdherentRow['Nom'] ;
                                break;
                            case 3: //Prenom                          
                                $Cells[$j] = $dataAdherentRow['Prenom'] ;
                                break;
                            case 4: // nomprenom AR
                                $Cells[$j] = $dataAdherentRow['NomAr'].' '.$dataAdherentRow['PrenomAr'] ;
                                break;
                            case 5: //NomAr
                                $Cells[$j] = $dataAdherentRow['NomAr'] ;
                                break;
                            case 6: //PrennomAr
                                $Cells[$j] = $dataAdherentRow['PrenomAr'] ;
                                break;
                            case 7: //CINN
                                $Cells[$j] ='CIN  :';
                                break;
                            case 8: //CIN
                                $Cells[$j] = $dataAdherentRow['CIN'] ;
                                break;
                            case 9: //PPRR
                                $Cells[$j] = 'PPR : ' ;
                                    break;
                            case 10: //PPR
                                $Cells[$j] = $dataAdherentRow['PPR'] ;
                                break;
                            case 11: //Naissance
                                $Cells[$j] = 'Né(e) le : ';   
                                break;
                            case 12: //DateNaissance
                                $Cells[$j] = $dataAdherentRow['DateNaissance'] ; 
                                break;
                            case 13: //Photo
                                $Cells[$j] = $dataAdherentRow['Photo'] ; 
                                break;
                            case 14: //CINN-CONJOIT
                                $Cells[$j] = ''; 
                                break;
                            case 15: //CIN-Conjit
                                $Cells[$j] = ''; 
                                break;
                            
                            case 16: //Adherent
                                $Cells[$j] = ''; 
                                break;
                            case 17: //Nom-Adherent
                                $Cells[$j] = ''; 
                                break;
                            case 18: //Prenom-adherent
                                $Cells[$j] = ''; 
                                break;
                            case 19: //CINN-Adherent
                                $Cells[$j] = ''; 
                                break;
                            case 20:  //CIN-Adhérent
                                $Cells[$j] = ''; 
                                break;
                            case 21: //PPRR-Adherent
                                $Cells[$j] = ''; 
                                break;
                            case 22: //PPR-Adhérent 
                                $Cells[$j] = ''; 
                                break;
                            default:
                                 break;
                        }

                    }
                         $alldatarows [$i] = $Cells ;
                         $sheet->fromArray($alldatarows[$i], null, 'A'.$rowIndex);
                         card::create([
                            'IdAdherent' => getAdherentId($dataAdherentRow['Aff']),
                        ]);
                         $rowIndex+=1; 
        }}

        $alldatarows = []; // initialing table 

        if(!empty($conjoints)){
        for ($i=0 ; $i<count($conjoints);$i++){
            foreach($conjoints[$i] as $key => $value) {
                    $dataConjointRow = $value ;  
                };
                    for ($j=0 ; $j<count($columnNames);$j++)
                        {
                        switch ($j) {
                            case 0: //'Aff'
                                $Cells[$j] = 'N°: '.$dataConjointRow['Aff'] ;
                                break;
                            case 1: //Qualité
                                $Cells[$j] = 'Qualité : '.$dataConjointRow['Qualité'] ;
                                break;
                            case 2: //nom
                                $Cells[$j] = $dataConjointRow['Nom'] ;
                                break;
                            case 3: //Prenom                          
                                $Cells[$j] = $dataConjointRow['Prenom'] ;
                                break;
                            case 4: // nomprenom AR
                                $Cells[$j] = $dataConjointRow['NomAr'].' '.$dataConjointRow['PrenomAr'] ;
                                break;
                            case 5: //NomAr
                                $Cells[$j] = $dataConjointRow['NomAr'] ;
                                break;
                            case 6: //PrennomAr
                                $Cells[$j] = $dataConjointRow['PrenomAr'] ;
                                break;
                            case 7: //CINN
                                $Cells[$j] ='';
                                break;
                            case 8: //CIN
                                $Cells[$j] = '' ;
                                break;
                            case 9: //PPRR
                                $Cells[$j] = '' ;
                                    break;
                            case 10: //PPR
                                $Cells[$j] = '' ;
                                break;
                            case 11: //Naissance
                                $Cells[$j] = '';   
                                break;
                            case 12: //DateNaissance
                                $Cells[$j] = '' ; 
                                break;
                            case 13: //Photo
                                $Cells[$j] = $dataConjointRow['Photo'] ; 
                                break;
                            case 14: //CINN-CONJOIT
                                $Cells[$j] = 'CIN :'; 
                                break;
                            case 15: //CIN-Conjit
                                $Cells[$j] = $dataConjointRow['CINConjoint']; 
                                break;
                            
                            case 16: //Adherent
                                $Cells[$j] = 'Adhérent :'; 
                                break;
                            case 17: //Nom-Adherent
                                $Cells[$j] = $dataConjointRow['NOMAdhérent']; 
                                break;
                            case 18: //Prenom-adherent
                                $Cells[$j] = $dataConjointRow['PRENOMAdhérent'];
                                break;
                            case 19: //CINN-Adherent
                                $Cells[$j] = 'CIN :'; 
                                break;
                            case 20:  //CIN-Adhérent
                                $Cells[$j] = $dataConjointRow['CINAdhérent']; 
                                break;
                            case 21: //PPRR-Adherent
                                $Cells[$j] = 'PPR :'; 
                                break;
                            case 22: //PPR-Adhérent 
                                $Cells[$j] = $dataConjointRow['PPR']; ; 
                                break;
                            default:
                                 break;
                        }

                    }
                         $alldatarows [$i] = $Cells ;
                         $sheet->fromArray($alldatarows[$i], null, 'A'.$rowIndex);
                         card::create([
                            'IdConjoint' => getConjointId($dataConjointRow['Aff']),
                        ]); 
                         $rowIndex+=1;
        }}
        $alldatarows = []; // initialing table

        if(!empty($enfants)){
        for ($i=0 ; $i<count($enfants);$i++){
            
            foreach($enfants[$i] as $key => $value) {
                            $dataEnfantRow = $value ;  
                };
            for ($j=0 ; $j<count($columnNames);$j++)
                    
                {
                        switch ($j) {
                            case 0: //'Aff'
                                $Cells[$j] = 'N°: '.$dataEnfantRow['Aff'] ;
                                break;
                            case 1: //Qualité
                                $Cells[$j] = 'Qualité : '.$dataEnfantRow['Qualité'] ;
                                break;
                            case 2: //nom
                                $Cells[$j] = $dataEnfantRow['Nom'] ;
                                break;
                            case 3: //Prenom                          
                                $Cells[$j] = $dataEnfantRow['Prenom'] ;
                                break;
                            case 4: // nomprenom AR
                                $Cells[$j] = $dataEnfantRow['NomAr'].' '.$dataEnfantRow['PrenomAr'] ;
                                break;
                            case 5: //NomAr
                                $Cells[$j] = $dataEnfantRow['NomAr'] ;
                                break;
                            case 6: //PrennomAr
                                $Cells[$j] = $dataEnfantRow['PrenomAr'] ;
                                break;
                            case 7: //CINN
                                $Cells[$j] ='';
                                break;
                            case 8: //CIN
                                $Cells[$j] = '' ;
                                break;
                            case 9: //PPRR
                                $Cells[$j] = '' ;
                                    break;
                            case 10: //PPR
                                $Cells[$j] = '' ;
                                break;
                            case 11: //Naissance
                                $Cells[$j] = 'Né(e) le : ';   
                                break;
                            case 12: //DateNaissance
                                $Cells[$j] = $dataEnfantRow['DateNaissance'] ; 
                                break;
                            case 13: //Photo
                                $Cells[$j] = $dataEnfantRow['Photo'] ; 
                                break;
                            case 14: //CINN-CONJOIT
                                $Cells[$j] = 'CIN :'; 
                                break;
                            case 15: //CIN-Conjit
                                $Cells[$j] = ''; 
                                break;
                            
                            case 16: //Adherent
                                $Cells[$j] = 'Adhérent :'; 
                                break;
                            case 17: //Nom-Adherent
                                $Cells[$j] = $dataEnfantRow['NOMAdhérent']; 
                                break;
                            case 18: //Prenom-adherent
                                $Cells[$j] = $dataEnfantRow['PRENOMAdhérent'];
                                break;
                            case 19: //CINN-Adherent
                                $Cells[$j] = 'CIN :'; 
                                break;
                            case 20:  //CIN-Adhérent
                                $Cells[$j] = $dataEnfantRow['CINAdhérent']; 
                                break;
                            case 21: //PPRR-Adherent
                                $Cells[$j] = 'PPR :'; 
                                break;
                            case 22: //PPR-Adhérent 
                                $Cells[$j] = $dataEnfantRow['CINAdhérent']; ; 
                                break;
                            default:
                                 break;
                        }

                }
                         $alldatarows [$i] = $Cells ;
                         $sheet->fromArray($alldatarows[$i], null, 'A'.$rowIndex); 
                        
                        card::create([
                            'IdEnfant' => getEnfantId($dataEnfantRow['Aff']),
                        ]);
        }}

//------------------------ SET STYLE : Header background-Color and Column Demension ------------------------- //
        $styleSet = [
            //  FILL
            "fill" => [
              // SOLID FILL
              "fillType" => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
              "color" => ["argb" => "E0E0E0E0"]
            ]
          ];
          
          $style = $sheet->getStyle("A1:W1");
          $style->applyFromArray($styleSet);
          foreach (range('A','W') as $key=>$col) {
            $spreadsheet->getActiveSheet()->getColumnDimension($col)->setWidth(20);  
          }
//------------------------ -------------------------------------------------------------- ------------------ //
//----------------------------------- SAVE TO SERVER & download ---------------------------------------------//
        
        $now = new DateTime();
       /*  $chemin= public_path()."\\downloads\\"; */
        $chemin= storage_path()."\\downloads\\";
        $fname = 'IMPRESSIONCARTES'.'_'. $now->format('d_m_Y_H_i_s');

        $filepath=$chemin.$fname.'.xlsx';

        $writer = new Xlsx($spreadsheet);
        $writer->save($filepath);
        return Response::download($filepath, $fname.'.xlsx');
        
    }
}
