<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recruiter;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Work>
 */
class WorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->jobTitle,
            'description' => $this->faker->paragraph,
            'contract_type' => $this->faker->randomElement(['Full-time', 'Part-time', 'Contract', 'Freelance']),
            'specialization' => $this->faker->jobTitle,
            'salary' => $this->faker->numberBetween(10000, 100000),
            'recruiter_id' => Recruiter::factory(),
        ];
    }
}
