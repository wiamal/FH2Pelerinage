<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelerinageFiles extends Model
{
    use HasFactory;
    protected $table = 'pelerinage-files';
    protected $primaryKey = ' IdFile ';
    // public $timestamps = false;
}
