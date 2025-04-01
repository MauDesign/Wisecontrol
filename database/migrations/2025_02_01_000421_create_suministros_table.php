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
        Schema::create('suministros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisicion_id');
            $table->unsignedBigInteger('material_id');
            $table->integer('cantidad_suministrada');
            $table->timestamps();

            $table->foreign('requisicion_id')->references('id')->on('requisiciones')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suministros');
    }
};
