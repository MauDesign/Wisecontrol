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
        Schema::dropIfExists('viaticos_req');

        Schema::create('viaticos_req', function (Blueprint $table) {
            $table->id(); // id primary key
            $table->unsignedBigInteger('id_requisicion'); // Relación con el proyecto
            $table->enum('tipo', ['transporte', 'hospedaje']); // Tipo de registro (transporte o hospedaje)
            $table->string('tipo_transporte')->nullable(); // Solo para transporte
            $table->string('origen')->nullable(); // Solo para transporte
            $table->string('destino')->nullable(); // Solo para transporte
            $table->date('fecha_salida')->nullable(); // Solo para transporte
            $table->string('lugar_hospedaje')->nullable(); // Solo para hospedaje
            $table->date('fecha_llegada')->nullable(); // Solo para hospedaje
            $table->date('fecha_salida_hospedaje')->nullable(); // Solo para hospedaje
            $table->integer('numero_personas'); // Común para ambos
            $table->timestamps();

            // Clave foránea
            $table->foreign('id_requisicion')->references('id')->on('requisiciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viaticos_req');
    }
};
