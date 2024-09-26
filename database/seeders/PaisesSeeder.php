<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paises;

class PaisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Paises::create([
            'nombre' => 'Colombia',
        ]);

        Paises::create([
            'nombre' => 'Brazil',
        ]);
    }
}
