<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

enum CouponType: string {
    case Percentage = "Percentage";
    case Fixed = "Fixed";
}

/**
 * @mixin IdeHelperCoupon
 */
class Coupon extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'code',
        'expires_at',
        'value',
        'discount_type',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'discount_type' => CouponType::class,
    ];

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }
}
