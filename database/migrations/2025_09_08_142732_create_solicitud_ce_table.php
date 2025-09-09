<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('solicitud_ce', function (Blueprint $table) {
        $table->id('id_solicitud');
        $table->string('nombre_dueno', 100);
        $table->string('correo', 100);
        $table->string('estado_economico', 50)->nullable();
        $table->string('nombre_mascota', 100);
        $table->string('especie', 50)->nullable();
        $table->string('raza', 50)->nullable();
        $table->enum('sexo', ['Macho', 'Hembra'])->nullable();
        $table->date('fecha');
        $table->text('descripcion')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('solicitud_ce');
}

};
