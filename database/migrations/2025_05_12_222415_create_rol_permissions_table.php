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
        Schema::create('rol_permissions', function (Blueprint $table) {
            $table->primary(['rol_id', 'permission_id']);
            $table->unsignedBigInteger('rol_id');
            $table->unsignedBigInteger('permission_id');
            $table->timestamps();

            $table->foreign('rol_id')->references('id')->on('rols')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rol_permissions');
    }
};
