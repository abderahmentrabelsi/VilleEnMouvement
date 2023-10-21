<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'screenshot',
    ];

    // Define the relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $table = 'complaint';

}

