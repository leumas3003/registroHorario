<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Empleado::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'user_id' => \App\Models\User::factory(),
            'nombre' => $this -> faker -> firstName(),
            'apellidos'  => $this -> faker -> lastName(),
            'identificacion' => $this -> faker -> imei(),
            'horasDia'  => $this -> faker -> numberBetween(7,8),
            'pin'  => '1234',
        ];
    }
}
