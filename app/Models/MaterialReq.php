<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialReq extends Model
{
    use HasFactory;

    protected $table = 'material_req';

    protected $fillable = [
        'fecha_solicitud',
        'requisiciones_id',
        'tipo_material',
        'material',
        'unidad_medida',
        'cantidad',
    ];

    public function requisicion()
    {
        return $this->belongsTo(Requisicion::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material', 'id'); // Asegúrate de que 'id' es la clave primaria en la tabla materiales
    }

    public function existencias()
    {
        return $this->material ? $this->material->Existencia : null;
    }

    public function unidadMedida()
    {
        return $this->belongsTo(CatMedida::class, 'unidad_medida');
    }

    public function tipoMaterial()
    {
        return $this->belongsTo(TipoMaterial::class, 'tipo_material');
    }
}
