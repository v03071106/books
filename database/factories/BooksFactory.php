<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Books>
 */
class BooksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $publishData = [fake()->dateTime(), null];
        return [
            'id' => fake()->uuid(),
            'title' => fake()->text(rand(10, 128)),
            'author' => fake()->name(10),
            'published_at' => $publishData[array_rand($publishData)],
            'category' => fake()->randomElement(['心靈', '理財', '成長', '投資'], 1),
            'price' => fake()->randomNumber(1, 5),
            'quantity' => fake()->randomNumber(1, 5),
            'images' => json_encode([
                'name' => fake()->title(),
                'path' => fake()->imageUrl(),
            ]),
        ];
    }
}
