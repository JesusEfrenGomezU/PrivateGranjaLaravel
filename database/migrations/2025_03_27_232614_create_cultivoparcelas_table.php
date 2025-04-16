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
        Schema::create('cultivoparcelas', function (Blueprint $table) {
            $table->id();
            $table->text('Descripcion');
            $table->date('FechaRegistro');
            $table->unsignedBigInteger('parcela_id');
            $table->unsignedBigInteger('cultivo_id');
            $table->timestamps();

            $table->foreign('parcela_id')->references('id')->on('parcelas')/*->onDelete('cascade')*/;
            $table->foreign('cultivo_id')->references('id')->on('cultivos');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cultivoparcelas');
    }
};
