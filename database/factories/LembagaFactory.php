<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lembaga>
 */
class LembagaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $createdAt = $this->faker->dateTimeBetween('-1 year', 'now');
        return [
            'nama_lembaga' => fake()->company(),
            'created_at' => Carbon::now(), // Atau bisa gunakan $this->faker->dateTime
            'updated_at' => Carbon::now(), // Atau bisa gunakan $this->faker->dateTi
        ];
    }
}
