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
        Schema::create('cotizaciones_general', function (Blueprint $table) {
            $table->id('id_cotizacion');
            $table->unsignedBigInteger('id_requisicion'); // Relación con requisiciones_general
            $table->date('fecha'); // Fecha de la cotización
            $table->decimal('total', 10, 2); // Total de la cotización
            $table->integer('estado')->default(0); // Estado de la cotización

            // Claves foráneas
            $table->foreign('id_requisicion')->references('id')->on('requisiciones');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizaciones_general');
    }
};
