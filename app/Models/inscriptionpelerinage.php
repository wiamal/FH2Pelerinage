<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscriptionPelerinage extends Model
{
    use HasFactory;

    protected $table = 'InscriptionPelerinage';
    protected $primaryKey = 'IdInscription';
    protected $fillable = [
        'IdAdherent',
        'IdPelerinage',
        'DateNaissance',
        'DateRecrutement',
        'DateRetraite',
        'Retraite',
        'IdStatutInscriptionPelerinage'
    ];
}
