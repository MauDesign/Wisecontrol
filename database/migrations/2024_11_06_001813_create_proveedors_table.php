<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Importa DB

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->string('Correo')->nullable();
            $table->string('Telefono')->nullable();
            $table->string('Direccion')->nullable();
            $table->string('RFC')->nullable();
            $table->string('Estado')->nullable();
            $table->string('Estatus');
            $table->timestamps();
        });

        // Insertar un proveedor por defecto
        DB::table('proveedors')->insert([
            'Nombre' => 'Sin asignar',
            'Correo' => null,
            'Telefono' => null,
            'Direccion' => null,
            'RFC' => null,
            'Estado' => null,
            'Estatus' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedors');
    }
};

