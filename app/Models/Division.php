<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $fillable = [

        'nom',
    ];

    public function Service()
    {
        return $this->hasMany(Service::class, 'division_id');
    }
    public function Fichier()
    {
        return $this->hasMany(Fichier::class, 'division_id');
    }
    public function User()
    {
        return $this->hasMany(User::class, 'division_id');
    }
}
