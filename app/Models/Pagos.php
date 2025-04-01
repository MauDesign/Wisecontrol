<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    use HasFactory;
    protected $table = 'pagos';
    protected $fillable = ['id_cotizacion', 'id_proveedor', 'monto', 'fecha',];

    public function cotizacion()
    {
        return $this->belongsTo(CotizacionGeneral::class, 'id_cotizacion', 'id_cotizacion');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id');
    }
}
