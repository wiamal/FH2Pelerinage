<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDocumentPelerinage extends Model
{
    use HasFactory;
    protected $table = 'TypeDocumentPelerinage';
    protected $primaryKey = ' IdTypeDocument ';
    public $timestamps = false;
}
