<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\ElseIf_;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Notifications\RegisteredUser;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /* Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        if (AdherentHasAccount(getAdherentId($request->CIN, $request->Affiliation))) {
            // adherent has an account
            return redirect(route('register'))->with('error', 'Cet utilisateur a déja un compte!');
        }
        if (!ExistAdherent($request->CIN, $request->Affiliation)) {
            // adherent doesn't exist 
            return redirect(route('register'))->with('error', 'Informations ne correspondent à aucun Adhérent');
        }

        event(new Registered($user = $this->create($request->all())));
        // create notification 
        // $user->notify(new RegisteredUser());
        return redirect(route('login'))->with('success', 'Votre compte a bien été créé');
    }

    public function confirm($id, $token)
    {
        /*  dd($id , $token);  */

        $user = User::where('id', '=', $id)->where('confirmation_token', '=', $token)->first();

        if ($user) {

            $user->confirmation_token = 'null';
            $user->save();
            $this->guard()->login($user);

            return redirect($this->redirectPath())->with('success', 'Votre compte a bien été confirmé');
        } else {
            return redirect(route('login'))->with('error', 'Ce lien ne semble pas valide');
        }
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'Affiliation' => ['required', 'string', 'max:255'],
            'CIN' => ['required', 'string', 'max:255'],
            'Affiliation' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users-pelerinage'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd($data);
        return User::create([
            /* 'name' => $data['name'], */
            'name' => getAdherentFullNameById(getAdherentId($data['CIN'], $data['Affiliation'])),
            'username' => $data['Affiliation'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // 'confirmation_token' => str_replace('/', '', bcrypt((Str::random((16))))),
            'idAdherent' => getAdherentId($data['CIN'], $data['Affiliation']),
        ]);
    }
}
