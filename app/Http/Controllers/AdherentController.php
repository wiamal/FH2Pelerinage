<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Adherent;
use Illuminate\Console\Events\ScheduledBackgroundTaskFinished;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class AdherentController extends Controller
{
    //
    public function index(){
        /* $adherent = DB::table('adherent')
                ->where([
                    ['CIN', '=', 'PY053'],
                    ['DateNaissance', '=', '2008-09-11'],
                    ['Affiliation', '=', '730942754']
                ])->first();
        
        if($adherent === null ) {
            // user doesn't exist 
            dd($adherent);
           }
           dd($adherent->IdAdherent); */
          
          /*  $hasAdherent = User::find(4)->adherent;
           dd($hasAdherent); */
    
    
        return view('dashboard.profile.profil');

        
        }


        public function edit(){

            return view('dashboard.profile.edit');
        }

        public function viewBeneficiaires(){
            return view('dashboard.profile.beneficiaires');
        }

        public function update(Request $request){
            if(Session::has('Adherent'))
            $Adherent=Session::get('Adherent');
            if($Adherent->IdAdherent != auth()->user()->idAdherent){
                abort(403,'Action non autorisée');
            }

            $formfields = $request->validate([
                'NomAr' => 'required',
                'PrenomAr' =>'required',
                'Adresse' => 'required',
                'GSM' => 'required'
            ]);

            Adherent::find($Adherent->IdAdherent)->update($formfields);
            
           /*  $Adherent::find($request->session()->get('Adherent')->IdAdherent)->update($formfields); */

            return redirect()->route('dashboard.profil')->with('success','Vos modifications ont été effectuées avec succès!');
        }

}