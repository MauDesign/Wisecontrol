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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cotizacion'); // Relación con cotizaciones_general
            $table->unsignedBigInteger('id_proveedor'); // Relación con la tabla de proveedores
            $table->decimal('monto', 10, 2);
            $table->date('fecha');
            $table->string('tipo_pago');
            $table->string('forma_pago');
            $table->integer('estatus')->default(0);
            $table->text('nota')->nullable();
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
        Schema::dropIfExists('pagos');
    }
};
