<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;


/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable
{
  use HasApiTokens;
  use HasFactory;
  use HasProfilePhoto;
  use HasTeams;
  use Notifiable;
  use TwoFactorAuthenticatable;
  use Billable;

  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = [
    'name', 'email', 'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
    'two_factor_recovery_codes',
    'two_factor_secret',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */
  protected $appends = [
    'profile_photo_url',
  ];

  public function wishlist()
  {
    return $this->belongsToMany(Product::class, 'wishlist', 'user_id', 'product_id');
  }

    // Define the relationship with Complaint model
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

  public function cart()
  {
    return $this->belongsToMany(
      Product::class,
      'carts', // Pivot table
      'user_id', // Foreign key on the carts table...
      'product_id' // Foreign key on the carts table...
    );
  }

  public function orders()
  {
    return $this->hasMany(Order::class);
  }
}
