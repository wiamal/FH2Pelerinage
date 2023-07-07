<?php

namespace App\Http\Controllers;


use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller 
{
    public function export() 
    {
       
        return Excel::download(new UsersExport, 'Users.csv', \Maatwebsite\Excel\Excel::CSV);

    }
}

