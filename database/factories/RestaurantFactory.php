<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->company();
        $comment = $this->faker->paragraph(2);
        $truncatedComment = Str::limit($comment, 10, '...');

        return [
            'user_id' => $this->faker->randomDigit(),
            'name' => $name,
            'name_katakana' => $name,
            'review' => $this->faker->numberBetween(1, 5),
            'food_picture' => $this->faker->imageUrl($width=150, $height=150, 'food'),
            'map_url' => $this->faker->url(),
            'phone_number' => $this->faker->phoneNumber(),
            'comment'=> $truncatedComment,
        ];
    }
}
