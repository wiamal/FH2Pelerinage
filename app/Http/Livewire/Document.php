<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

class Document extends Component
{
    public $filename;
    public $path;

    public function openPdf($filename, $path)
    {
        $this->filename = $filename;
        $this->path = $path;

        return $this->redirect(route('pdf.show'));
    }

    public function render()
    {
        return view('livewire.document-component');
    }
}
