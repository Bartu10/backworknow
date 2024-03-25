<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Recruiter;
use App\Models\Work;
use App\Models\Request;
use App\Models\Estudio;
use App\Models\Experiencia;
use App\Models\Message;
use App\Models\Chat;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear usuario administrador
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('contraseña'),
            // Añade otros campos según sea necesario
        ]);


        $admin_recruiter = Recruiter::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'company' => 'admin',
            'password' => bcrypt('contraseña'),
        ]);

        // Crear 2 experiencias para el usuario administrador
        $admin->experiencias()->createMany(
            Experiencia::factory()->count(2)->make()->toArray()
        );

        // Crear 2 estudios para el usuario administrador
        $admin->estudios()->createMany(
            Estudio::factory()->count(2)->make()->toArray()
        );

        // Crear usuarios de prueba
        $users = User::factory()->count(9)->create();

        // Crear reclutadores de prueba
        $recruiters = Recruiter::factory()->count(5)->create();

        // Crear trabajos de prueba asociados a los reclutadores
        $works = Work::factory()->count(20)->create()->each(function ($work) use ($recruiters) {
            $work->recruiter()->associate($recruiters->random())->save();
        });

        // Crear solicitudes de prueba asociadas a usuarios, reclutadores y trabajos
        Request::factory()->count(30)->create()->each(function ($request) use ($users, $recruiters, $works) {
            $request->user()->associate($users->random())->save();
            $request->recruiter()->associate($recruiters->random())->save();
            $request->work()->associate($works->random())->save();
        });

        // Crear estudios de prueba asociados a usuarios
        $users->each(function ($user) {
            Estudio::factory()->count(3)->create(['user_id' => $user->id]);
        });

        // Crear experiencias de prueba asociadas a usuarios
        $users->each(function ($user) {
            Experiencia::factory()->count(5)->create(['user_id' => $user->id]);
        });

        Message::factory()->count(100)->create();
    }
}
