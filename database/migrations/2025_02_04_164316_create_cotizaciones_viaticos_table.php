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
        Schema::create('cotizaciones_viaticos', function (Blueprint $table) {
            $table->id('id_viaticos');
            $table->unsignedBigInteger('id_cotizacion'); // Relación con cotizaciones_general
            $table->unsignedBigInteger('id_proveedor'); // Relación con la tabla de proveedores
            $table->integer('cantidad');
            $table->integer('unidad')->nullable();
            $table->decimal('precio_unitario', 10, 2); // Precio unitario del producto/servicio
            $table->decimal('subtotal', 10, 2)->storedAs('cantidad * precio_unitario');
            $table->timestamps();
            
            // Define foreign key constraint if needed
            $table->foreign('id_cotizacion')->references('id_cotizacion')->on('cotizaciones_general')->onDelete('cascade');
            $table->foreign('id_proveedor')->references('id')->on('proveedors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizaciones_viaticos');
    }
};
