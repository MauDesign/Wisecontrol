<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Cliente;
use App\Models\Requisicion;
use App\Http\Controllers\Controller;
use App\Http\Controller\PagosController;
use Illuminate\Http\Request;
use Illuminat\Support\Facades\DB;
use App\Http\Requests\AltaProyectosRequest;
use App\Models\User;
use App\Models\Pagos;
use Illuminate\Foundation\Auth\User as AuthUser;

class ProyectosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyectos = Proyecto::with(['requisiciones.cotizaciones.pagos'])->get();

        foreach ($proyectos as $proyecto) {
            $totalGastos = 0;
            foreach ($proyecto->requisiciones as $requisicion) {
                foreach ($requisicion->cotizaciones as $cotizacion) {
                    $totalGastos += $cotizacion->pagos->sum('monto');
                }
            }
            $proyecto->total_gastos = $totalGastos;
        }
        $clientes = Cliente::all();
        $usuarios = User::all();
        return view('proyectos.index', ['proyectos' => $proyectos, 'clientes' => $clientes, 'usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $usuarios = User::all();
        $proyecto = new Proyecto([
            'Nombre_proyecto' => '',
            'Cliente' => null,
            'Presupuesto' => '',
            'Fecha_diseno' => '',
            'Fecha_obra' => '',
            'Fecha_fin' => '',
            'Responsable' => '',
        ]);
        return view('proyectos.create', compact('proyecto', 'clientes', 'usuarios'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AltaProyectosRequest $request)
    {
        Proyecto::create($request->validated());

        return to_route('proyectos.index')->with('status', 'proyecto agregado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto)
    {
       // Obtener la suma de pagos aprobados para este proyecto
       $totalPagosAprobados = Pagos::where('estatus', 'Aprobado')
       ->whereIn('id_cotizacion', function ($query) use ($proyecto) {
           $query->select('id')
               ->from('cotizaciones_general')
               ->whereIn('id_requisicion', function ($query) use ($proyecto) {
                   $query->select('id')
                       ->from('requisiciones')
                       ->where('proyecto_id', $proyecto->id);
               });
       })
       ->sum('monto');

       $pagosProyecto = Pagos::whereIn('id_cotizacion', function ($query) use ($proyecto) {
           $query->select('id')
               ->from('cotizaciones_general')
               ->whereIn('id_requisicion', function ($query) use ($proyecto) {
                   $query->select('id')
                       ->from('requisiciones')
                       ->where('proyecto_id', $proyecto->id);
               });
       })
       ->get();

       $requisiciones = Requisicion::where('proyecto_id', $proyecto->id)->get();

   return view('proyectos.show', [
       'proyecto' => $proyecto,
       'totalPagosAprobados' => $totalPagosAprobados, // Pasar la suma a la vista
       'requisiciones' => $requisiciones,
        'pagosProyecto' => $pagosProyecto,
   ]);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto)
    {
        $clientes = Cliente::all();
        $usuarios = User::all();
        return view('proyectos.edit', ['proyecto' => $proyecto, 'clientes' => $clientes, 'usuarios' => $usuarios]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AltaProyectosRequest $request, Proyecto $proyecto)
    {
        $proyecto->update($request->validated());
        return to_route('proyectos.index', $proyecto)->with('success', 'Proyecto actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $proyecto)
    {
        $proyecto = Proyecto::findOrFail($proyecto);
        $proyecto->delete();
        return redirect()->route('proyectos.index')->with('warning', 'Proyecto eliminado exitosamente.');
    }
}
