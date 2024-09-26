<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
             $table->id();
             $table->string('nombres');
             $table->string('apellidos');
             $table->string('identificacion')->unique();
             $table->string('direccion');
             $table->string('telefono');
             $table->foreignId('ciudad_id')->constrained('ciudades'); // Relación con ciudades
             $table->boolean('is_active')->default(true); // Borrado lógico
             $table->timestamps();
         });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('empleados');
    }
};
