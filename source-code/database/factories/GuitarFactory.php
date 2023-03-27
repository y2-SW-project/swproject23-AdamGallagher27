<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Guitar;
use App\Models\User;
use App\Models\Type;
use App\Models\Condition;

use Illuminate\Support\Facades\DB;


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
            "bid_expiration" => $this->faker->dateTime,
            "price" => $this->faker->numberBetween(50, 200),
            "user_id" => $this->faker->randomElement(User::pluck("id")),
            "condition_id" => $this->faker->numberBetween(1, 5),
            "type_id" => $this->faker->numberBetween(1, 5)

        ];
    }
}
