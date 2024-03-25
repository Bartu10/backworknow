<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Experiencia>
 */
class ExperienciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'empresa' => $this->faker->company,
            'cargo' => $this->faker->jobTitle,
            'fecha_inicio' => $this->faker->date,
            'fecha_fin' => $this->faker->date,
            'descripcion' => $this->faker->paragraph,
            'user_id' => User::factory()->create()->id
        ];
    }
}
