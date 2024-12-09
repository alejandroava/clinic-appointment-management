<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $days = collect(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'])
             ->random(5)  // Selecciona 5 días aleatorios
             ->implode(','); // Convierte el array en una cadena separada por comas

        return [
            'days_of_week' => $days,
            'start_time' => $this->faker->time('H:i', '06:00'), // Hora aleatoria a partir de las 6 AM
            'end_time' => $this->faker->time('H:i', '14:00'),   // 8 horas después
        ];
    }
}
