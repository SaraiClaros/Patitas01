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
        Schema::table('mascota_adopcion', function (Blueprint $table) {
            $table->unsignedBigInteger('usuario_id')->after('ID_mascota_adop')->nullable();
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mascota_adopcion', function (Blueprint $table) {
                $table->dropForeign(['usuario_id']);
                $table->dropColumn('usuario_id');

        });
    }
};
