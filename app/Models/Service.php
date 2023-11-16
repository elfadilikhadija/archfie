<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'division_id',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'service_id');
    }
        public function division()
    {
        return $this->belongsTo(division::class, 'division_id');
    }
    
}
