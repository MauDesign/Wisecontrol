<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidades extends Model
{
    use HasFactory;
    protected $table = 'cat_medidas';
    protected $fillable = ['Unidad_medidas', 'clave_unidad'];
}