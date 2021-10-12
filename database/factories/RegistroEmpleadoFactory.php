<?php

namespace Database\Factories;

use App\Models\RegistroEmpleado;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class RegistroEmpleadoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RegistroEmpleado::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $today = Carbon::now();
        return [
            'dia' => $today->subDays(10),
            'empleado_id' => \App\Models\Empleado::factory(),
            'horaEntrada' => $this -> faker -> time(),
            'horaSalida' => $this -> faker -> time(),
        ];
    }
}
