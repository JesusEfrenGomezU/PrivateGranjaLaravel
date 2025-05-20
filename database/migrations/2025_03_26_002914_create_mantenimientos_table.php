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
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parcela_id');
            //$table->unsignedBigInteger('usuario_id');
            $table->string('Descripcion', 40);
            $table->date('FechaMantenimiento');
            $table->timestamps();

            $table->foreign('parcela_id')->references('id')->on('parcelas');
            //$table->foreign('usuario_id')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};
