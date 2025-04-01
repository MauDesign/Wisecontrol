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
        Schema::create('cotizaciones_detalle', function (Blueprint $table) {
            $table->id('id_detalle'); // Identificador único
            $table->unsignedBigInteger('id_cotizacion'); // Relación con cotizaciones_general
            $table->unsignedBigInteger('id_material'); // Relación con materiales
            $table->unsignedBigInteger('id_proveedor'); // Relación con la tabla de proveedores
            $table->integer('cantidad'); // Cantidad de productos/servicios
            $table->string('unidad_medida'); // Unidad de medida
            $table->decimal('precio_unitario', 10, 2); // Precio unitario del producto/servicio

            // Subtotal calculado
            $table->decimal('subtotal', 10, 2)->storedAs('cantidad * precio_unitario');

            // Claves foráneas
            $table->foreign('id_cotizacion')->references('id_cotizacion')->on('cotizaciones_general')->onDelete('cascade');
            $table->foreign('id_material')->references('id')->on('materials')->onDelete('cascade');
            $table->foreign('id_proveedor')->references('id')->on('proveedors');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizaciones_detalle');
    }
};
