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
        Schema::create('requisiciones', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_solicitud')->nullable();
            $table->integer('estatus')->default(0);
            $table->string('observaciones')->nullable();
            $table->integer('tipo')->nullable();
            $table->unsignedBigInteger('proyecto_id'); 
            $table->timestamps();
    
            // Definir la clave foránea para la relación con la tabla 'proyectos'
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisiciones');
    }
};
