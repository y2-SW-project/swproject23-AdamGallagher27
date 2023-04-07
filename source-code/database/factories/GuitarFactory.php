<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guitar>
 */
class GuitarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->word,
            "description" => $this->faker->text(50),
            "make" => $this->faker->word,
            "bid_expiration" => $this->faker->dateTimeBetween('+0 days', '+1 week'),
            "price" => $this->faker->numberBetween(50, 200),
            "user_id" => $this->faker->randomElement(User::pluck("id")),
            "condition_id" => $this->faker->numberBetween(1, 5),
            "type_id" => $this->faker->numberBetween(1, 5),
            "image" => 'images/home' . rand(1, 6)
        ];
    }
}
