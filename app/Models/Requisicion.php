<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisicion extends Model
{
    use HasFactory;
    protected $table = 'requisiciones';

    protected $fillable = ['proyecto_id', 'fecha_solicitud', 'estatus', 'tipo'];

    public function materiales()
    {
        return $this->hasMany(MaterialReq::class);
    }

    public function materialReqs()
    {
        return $this->hasMany(MaterialReq::class, 'requisiciones_id');
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id'); 
    }

    public function unidadMedida()
    {
        return $this->belongsTo(Unidades::class, 'Unidad_medida', 'id');
    }

    public function tipoMaterial()
    {
        return $this->belongsTo(TipoMaterial::class, 'Tipo_material', 'id');
    }

    public function cotizaciones()
    {
        return $this->hasMany(CotizacionGeneral::class, 'id_requisicion', 'id');
    }

    public function items()
    {
        return $this->hasMany(ViaticosReq::class, 'id_requisicion');
    }
}
