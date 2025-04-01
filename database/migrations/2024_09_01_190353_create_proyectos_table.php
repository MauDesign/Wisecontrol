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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_proyecto');
            $table->string('Cliente');
            $table->integer('Presupuesto');
            $table->decimal('Gastos', 10, 2)->nullable();
            $table->date('Fecha_diseno')->nullable();
            $table->date('Fecha_obra')->nullable();
            $table->date('Fecha_fin')->nullable();
            $table->date('Fecha_entrega')->nullable();
            $table->string('Responsable');
            $table->integer('id_usuario')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
