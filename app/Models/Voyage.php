<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @mixin IdeHelperVoyage
 */
class Voyage extends Model
{
  use HasFactory;

  protected $fillable = [
    'date_voyage',
    'heure',
    'nbr_places',
    'lieu_depart',
    'lieu_arrive',
    'prix',
    'telephone',
    'user_id',
  ];

  protected $casts = [
    'date_voyage' => 'date',
  ];


  public function orders()
  {
    return $this->morphToMany(Order::class, 'orderable')->withPivot('quantity');
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }
}
