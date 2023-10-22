<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

enum OrderStatus: string
{
  case PENDING = 'pending';
  case COMPLETED = 'completed';
  case CANCELLED = 'cancelled';
}

/**
 * @mixin IdeHelperOrder
 */
class Order extends Model
{
  use SoftDeletes, HasFactory;

  protected $fillable = [
    'payment_intent_id', 'status', 'sum'
  ];

  protected $casts = [
    'status' => OrderStatus::class,
  ];

  public function voyages(): \Illuminate\Database\Eloquent\Relations\MorphToMany
  {
    return $this->morphedByMany(Voyage::class, 'orderable')->withPivot('quantity');
  }

  public function products(): \Illuminate\Database\Eloquent\Relations\MorphToMany
  {
    return $this->morphedByMany(Product::class, 'orderable')->withPivot('quantity');
  }

  public function buyer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(User::class, 'buyer_id');
  }

  public function coupon(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->HasOne(Coupon::class, 'coupon_id');
  }
}
