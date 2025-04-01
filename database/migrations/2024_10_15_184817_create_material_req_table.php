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
        Schema::create('material_req', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fecha_solicitud')->nullable();
            $table->unsignedBigInteger('requisiciones_id'); // Define la columna antes de agregar la restricción
            $table->foreign('requisiciones_id')->references('id')->on('requisiciones')->onDelete('cascade');
            $table->integer('tipo_material');
            $table->integer('material');
            $table->integer('unidad_medida');
            $table->integer('cantidad');
            $table->integer('cantidad_suministrada')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_req');
    }
};
