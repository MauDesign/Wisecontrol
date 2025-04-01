<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = ['Nombre', 'Correo', 'Telefono','Direccion','RFC','CP','Regimen_fiscal'];

}
