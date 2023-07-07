<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class retraite extends Model
{
    use HasFactory;
    protected $table = 'retraite'; 
    protected $primaryKey = 'IdRetraite';
    public function adherent()
    {
        return $this->belongsTo(Adherent::class, 'IdAdherent');
    }
}
