<?php

namespace Database\Seeders;

use App\Models\Ciudades;
use Illuminate\Database\Seeder;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ciudades::create([
            'nombre' => 'Bogota',
            'pais_id' => 1,
        ]);

        Ciudades::create([
            'nombre' => 'Rio Janeiro',
            'pais_id' => 2,
        ]);
    }
}
