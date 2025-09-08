<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solicitudes_adopcion', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('usuario_id');  
            $table->unsignedBigInteger('mascota_id');
            $table->text('motivo');
            $table->string('Nombre');
            $table->string('DUI');
            $table->string('edad');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('tipo_casa');
            $table->string('personas_casa');
            $table->string('personas_enteradas');
            $table->string('mascotas_casa');
            $table->string('visitas');
            
    
    $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('mascota_id')->references('ID_mascota_adop')->on('mascota_adopcion')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_adopcion');
    }
};
