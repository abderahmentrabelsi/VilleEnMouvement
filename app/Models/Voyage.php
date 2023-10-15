<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    protected $fillable = [
        'date_voyage',
        'heure',
        'nbr_places',
        'lieu_depart',
        'lieu_arrive',
    ];
}
