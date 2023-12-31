<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperLikes
 */
class Likes extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
