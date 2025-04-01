<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionDetalle extends Model
{
    use HasFactory;
    protected $table = 'cotizaciones_detalle';
    protected $primaryKey = 'id_detalle';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = ['id_cotizacion', 'id_material', 'id_proveedor', 'cantidad', 'unidad_medida', 'precio_unitario', 'subtotal'];

    public function cotizacionGeneral()
    {
        return $this->belongsTo(CotizacionGeneral::class, 'id_cotizacion', 'id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'id_material', 'id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id');
    }

    public function cotizacion()
    {
        return $this->belongsTo(CotizacionGeneral::class, 'id_cotizacion');
    }
}
