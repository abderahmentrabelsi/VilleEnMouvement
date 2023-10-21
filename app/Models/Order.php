<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'payment_intent_id',
    ];

    public function voyages()
    {
        return $this->morphedByMany(Voyage::class, 'orderable')->withPivot('quantity');
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'orderable')->withPivot('quantity');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}
