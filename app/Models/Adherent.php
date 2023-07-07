<?php

namespace App\Models;

use App\Models\User;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Adherent extends Model
{
    use HasFactory, Searchable;

    protected $table = 'ab6';
    protected $primaryKey = 'id_adh';

    protected $fillable = ['Nom', 'Prenom', 'Affiliation', 'CIN', 'DateNaissance', 'NomAr', 'PrenomAr', 'Adresse', 'GSM', 'Fixe', 'Genre'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fonction()
    {
        return $this->hasMany(Fonction::class, 'id_adh');
    }
    public function retraite()
    {
        return $this->hasMany(retraite::class, 'id_adh');
    }

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'Affiliation';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */

    public function toSearchableArray()
    {
        // Customize array...
        return [
            'affiliation' => $this->Affiliation,
            'nom' => $this->Nom,
            'prenom' => $this->Prenom,
            'nomar' => $this->NomAr,
            'prenomar' => $this->PrenomAr,
            'cin' => $this->CIN
        ];
    }
}
