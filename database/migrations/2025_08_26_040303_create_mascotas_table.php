<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_m');
            $table->string('especie');
            $table->string('raza')->nullable();
            $table->string('sexo', 10);
            $table->integer('edad');
            $table->foreignId('ID_dueno')->nullable()->constrained('duenos');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mascotas');
    }
};
