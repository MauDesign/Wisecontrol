<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMaterial extends Model
{
    use HasFactory;
    protected $table = 'tipo_materials';
    protected $fillable = ['Tipo_material'];
}
