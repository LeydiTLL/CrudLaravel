<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empleado;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empleado::create([
            'nombres' => 'Juan',
            'apellidos' => 'Pérez',
            'identificacion' => '1234567890',
            'direccion' => 'Calle Falsa 123',
            'telefono' => '555-1234',
            'ciudad_id' => 1, // Asegúrate de tener una ciudad con ID 1 en la tabla de ciudades
            'is_active' => true,
        ]);

        Empleado::create([
            'nombres' => 'María',
            'apellidos' => 'López',
            'identificacion' => '9876543210',
            'direccion' => 'Avenida Siempre Viva 742',
            'telefono' => '555-5678',
            'ciudad_id' => 2, // Asegúrate de tener una ciudad con ID 2 en la tabla de ciudades
            'is_active' => true,
        ]);
    }
}
