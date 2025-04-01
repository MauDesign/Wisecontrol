<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionGeneral extends Model
{
    use HasFactory;
    protected $table = 'cotizaciones_general';
    protected $primaryKey = 'id_cotizacion';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['id_requisicion', 'fecha', 'id_proveedor', 'total', 'estado'];


    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id');
    }

    public function requisicion()
    {
        return $this->belongsTo(Requisicion::class, 'id_requisicion', 'id');
    }

    public function detalles()
    {
        return $this->hasMany(CotizacionDetalle::class, 'id_cotizacion', 'id_cotizacion');
    }

    public function viaticos()
    {
        return $this->hasMany(CotizacionViaticos::class, 'id_cotizacion');
    }

    public function pagos()
    {
        return $this->hasMany(Pagos::class, 'id_cotizacion', 'id_cotizacion');
    }
}
