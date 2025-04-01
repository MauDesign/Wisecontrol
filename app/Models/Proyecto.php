<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;
    protected $fillable = ['Nombre_proyecto', 'Cliente', 'Presupuesto', 'Gastos', 'Fecha_diseno', 'Fecha_fin', 'Fecha_obra', 'Responsable'];

    public function cliente() // Método para definir la relación
    {
        return $this->belongsTo(Cliente::class, 'cliente_id'); // 'cliente_id' es la clave foránea en la tabla 'proyectos'
    }

    public function requisiciones()
    {
        return $this->hasMany(Requisicion::class);
    }
}
