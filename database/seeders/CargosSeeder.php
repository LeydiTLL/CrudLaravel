<?php

namespace Database\Seeders;

use App\Models\Cargos;
use Illuminate\Database\Seeder;

class CargosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cargos::create([
            'nombre' => 'Desarrollador',
        ]);

        Cargos::create([
            'nombre' => 'Contadora',
        ]);
    }
}
