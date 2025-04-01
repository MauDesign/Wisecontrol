<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $fillable = ['Material', 'Existencia', 'Unidad_medida', 'Tipo_material'];

    public function nombreMaterial()
    {
        return $this->belongsTo(Unidades::class, 'Material', 'id');
    }

    public function unidadMedida()
    {
        return $this->belongsTo(Unidades::class, 'Unidad_medida', 'id');
    }

    public function tipoMaterial()
    {
        return $this->belongsTo(TipoMaterial::class, 'Tipo_Material', 'id');
    }
}
