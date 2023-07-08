<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

class PdfController extends Controller
{
    public function show(Request $request)
    {

        $filename = $request->input('filename');
        $path = $request->input('path');

        $pdfPath = $path;

        return Response::make(File::get($pdfPath), 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
