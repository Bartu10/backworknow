<?php

namespace Database\Factories;
use App\Models\Request;
use App\Models\User;
use App\Models\Recruiter;
use App\Models\Work;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(['Pending', 'Approved', 'Rejected']),
            'description' => $this->faker->sentence,
            'user_id' => User::factory(),
            'recruiter_id' => Recruiter::factory(),
            'work_id' => Work::factory(),
        ];
    }
}
