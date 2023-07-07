<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inscriptionpelerinage extends Model
{
    use HasFactory;
    
    protected $table = 'inscriptionpelerinage'; 
    protected $primaryKey = 'IdInscrition';
    protected $fillable = [
        'IdAdherent',
        'IdPelerinage',
        'DateNaissance',
        'DateRecrutement',
        'EtatFonction',
        'DejaBeneficier',
        'Pelerinage1Fois',
        'DemandeFH2',
        'DeclaratioHonneurFH2',
        'RecuDepenses',
        'Visa',
        'Passport',
        'RIB',
    ];
}
