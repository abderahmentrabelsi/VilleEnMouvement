<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Complaint;

class ComplaintFactory extends Factory
{
    protected $model = Complaint::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'screenshot' => $this->faker->imageUrl(), // Generates a random image URL, you can customize this
        ];
    }
}
