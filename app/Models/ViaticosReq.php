<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViaticosReq extends Model
{
    use HasFactory;

    protected $table = 'viaticos_req';

    protected $fillable = [
        'id_requisicion',
        'tipo',
        'tipo_transporte',
        'origen',
        'destino',
        'fecha_salida',
        'lugar_hospedaje',
        'fecha_llegada',
        'fecha_salida_hospedaje',
        'numero_personas',
    ];
}
