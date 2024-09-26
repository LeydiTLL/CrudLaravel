<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('empleado_cargo', function (Blueprint $table) {
            $table->foreignId('empleado_id')->constrained('empleados');
            $table->foreignId('cargo_id')->constrained('cargos');
            $table->timestamps();
        });
    }    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleado_cargo');
    }
};
