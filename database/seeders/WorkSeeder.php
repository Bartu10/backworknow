<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Work;

class WorkSeeder extends Seeder
{
    public function run()
    {
        Work::create([
            'name' => 'Desarrollador Full Stack',
            'description' => 'Desarrollador con experiencia en tecnologías frontend y backend.',
            'contract_type' => 'Tiempo completo',
            'specialization' => 'Tecnología de la Información',
            'salary' => 50000.00,
        ]);

        Work::create([
            'name' => 'Analista de Datos',
            'description' => 'Analista experto en minería de datos y análisis estadístico.',
            'contract_type' => 'Medio tiempo',
            'specialization' => 'Ciencia de Datos',
            'salary' => 60000.00,
        ]);

        // Agrega más trabajos según sea necesario
    }
}

