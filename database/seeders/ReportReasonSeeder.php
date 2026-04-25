<?php

namespace Database\Seeders;

use App\Models\ReportReason;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ReportReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reasons = [
            ['name' => 'Spam', 'description' => 'Contenido repetitivo o promocional no solicitado.'],
            ['name' => 'Contenido inapropiado', 'description' => 'Contenido ofensivo o no apto para la comunidad.'],
            ['name' => 'Información falsa', 'description' => 'Datos potencialmente engañosos o inventados.'],
            ['name' => 'Publicación duplicada', 'description' => 'Contenido duplicado del mismo caso.'],
            ['name' => 'Posible chantaje', 'description' => 'Indicios de extorsión o chantaje vinculados al caso.'],
            ['name' => 'Fraude o intento de cobro sospechoso', 'description' => 'Solicitud de pagos indebidos o actividad fraudulenta.'],
            ['name' => 'Maltrato animal', 'description' => 'Contenido que sugiere violencia o maltrato hacia animales.'],
            ['name' => 'Datos personales expuestos', 'description' => 'Publicación de datos sensibles o privados.'],
            ['name' => 'Acoso o insultos', 'description' => 'Lenguaje hostil, amenazas o acoso.'],
            ['name' => 'Otro', 'description' => 'Motivo distinto no listado.'],
        ];

        foreach ($reasons as $reason) {
            ReportReason::query()->updateOrCreate(
                ['slug' => Str::slug($reason['name'])],
                [
                    'name' => $reason['name'],
                    'description' => $reason['description'],
                    'applies_to' => ['posts', 'comments', 'sightings', 'users'],
                    'active' => true,
                ]
            );
        }
    }
}
