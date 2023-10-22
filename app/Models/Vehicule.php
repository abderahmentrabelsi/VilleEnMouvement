<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'model',
        'type',
        'capacity',
        'price',
        'plateNumber',  
        'chauffeur',   
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $table = 'vehicule';
}
