<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountSetting extends Controller
{
    //
    public function editPassword(){
        return view('dashboard.profile.changePassword');
    }

    public function changePassword(Request $request){

            if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
                // The passwords matches
                return redirect()->back()->with("error","Votre mot de passe actuel ne correspond pas au mot de passe que vous avez fourni. Veuillez réessayer.");
            }
        
            if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
                //Current password and new password are same
               
                return redirect()->back()->with("error","Le nouveau mot de passe ne peut pas être le même que votre mot de passe actuel. Veuillez choisir un autre mot de passe.");
            }
        
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|string|min:8|confirmed',

            ]);

            
           
            //Change Password
           /*  $user = Auth::user();
            $user->password = Hash::make($request->newPassword);
            $user->save();  */

           /* $request->user()->fill([
                'password' => Hash::make($request->get('new_password'))
            ])->save(); */

            User::find(Auth::user()->id)->update(['password'=>Hash::make($request->get('new_password'))]);
        
            return redirect()->back()->with("success","Le mot de passe a été modifié avec succès !");

    }

       
    
}
