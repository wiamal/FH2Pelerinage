<?php

namespace App\Http\Controllers;

use App\Models\Adherent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

class TextSearchController extends Controller
{
    //
    public function index(Request $request)
    {
        $adherents = Adherent::search($request->search)->get();
        /* if($request->has('query')){
            $adherents = Adherent::search($request->query)
                ->paginate(1);
        }else{
            $adherents = Adherent::paginate(1);
        } */
        $textsearch = $request->search;
        
        return view('dashboard.search.search', compact('adherents','textsearch'));
    }
}
