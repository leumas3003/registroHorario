<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //\App\Models\User::factory(10)->create();
         //\App\Models\Empresa::factory(5)->create();
         //\App\Models\Empleado::factory(10)->create();
         \App\Models\RegistroEmpleado::factory(20)->create();
    }
}
