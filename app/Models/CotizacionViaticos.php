<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionViaticos extends Model
{
    use HasFactory;
    protected $table = 'cotizaciones_viaticos';
    protected $fillable = ['id_cotizacion', 'id_proveedor', 'cantidad', 'noches', 'personas', 'precio_unitario', 'subtotal'];
}
