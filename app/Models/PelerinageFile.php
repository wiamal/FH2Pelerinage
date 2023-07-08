<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelerinageFile extends Model
{
    use HasFactory;
    protected $table = 'pelerinage-files';
    protected $primaryKey = ' IdFile ';
    // public $timestamps = false;

    protected $fillable = [
        'URL',
        'IdInscription',
        'IdTypeDocument',
    ];
}
