<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperProduct
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_url',
        'rating',
        'price',
        'description',
        'company_name',
    ];



    public function getStarRatingAttribute()
    {
        // You can calculate the star rating based on your data.
        $filledStars = $this->rating;
        $unfilledStars = 5 - $filledStars;

        $starRatingHTML = '';
        for ($i = 0; $i < $filledStars; $i++) {
            $starRatingHTML .= '<i data-feather="star" class="filled-star"></i>';
        }
        for ($i = 0; $i < $unfilledStars; $i++) {
            $starRatingHTML .= '<i data-feather="star" class="unfilled-star"></i>';
        }

        return $starRatingHTML;
    } // <- ya kolleb mayjiwch hna rendering html

    public function orders()
    {
        return $this->morphToMany(Order::class, 'orderable')->withPivot('quantity');
    }

}

