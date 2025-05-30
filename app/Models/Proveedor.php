<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table = 'proveedors';
    protected $fillable = ['Nombre', 'Correo', 'Telefono','Direccion','RFC', 'Regimen_fiscal','CP','Estado', 'Estatus'];
}
