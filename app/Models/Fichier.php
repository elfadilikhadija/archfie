<?php // app/Models/YourModelName.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fichier extends Model{


    protected $fillable = [
    'objet',
    'numero',
    'destinateurt',
    'destinataire',
    'date',
    'division_id',
    'categorie_id',
    'service_id',
    'fichier',
    'archiver'
];


    // Relationships
    public function division()
{
    return $this->belongsTo(Division::class, 'division_id');
}

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }



    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

}
