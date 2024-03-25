<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Message;
use App\Models\User;
use App\Models\Chat;
use App\Models\Recruiter;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition()
    {
        // Obtenemos un reclutador (recruiter) aleatorio
        $recruiter = Recruiter::inRandomOrder()->first();

        // Obtenemos un usuario (user) aleatorio
        $user = User::inRandomOrder()->first();

        // Verificar si tanto $user como $recruiter no son null
        if ($user && $recruiter) {
            // Creamos el chat entre el reclutador y el usuario
            $chat = Chat::factory()->create([
                'user_id' => $user->id,
                'recruiter_id' => $recruiter->id,
            ]);

            // Seleccionamos un ID de sender de manera aleatoria entre el reclutador y el usuario
            $senderId = $this->faker->randomElement([$recruiter->id, $user->id]);

            // Creamos el mensaje con los IDs de reclutador y usuario seleccionados
            return [
                'chat_id' => $chat->id,
                'sender_id' => $senderId,
                'sender_type' => function (array $attributes) use ($recruiter, $senderId) {
                    return $attributes['sender_id'] === $recruiter->id ? 'recruiter' : 'user';
                },
                'message_text' => $this->faker->sentence,
            ];
        } else {
            // If either $user or $recruiter is null, return an empty array
            return [];
        }
    }
}
