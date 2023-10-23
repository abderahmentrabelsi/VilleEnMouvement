<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperRating
 */
class Rating extends Model
{
    protected $table = 'ratings';

    protected $fillable = ['user_id', 'rating_value', 'comments'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}