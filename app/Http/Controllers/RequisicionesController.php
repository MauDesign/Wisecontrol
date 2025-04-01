<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Requisicion;
use App\Http\Controllers\Controller;
use App\Models\CotizacionDetalle;
use App\Models\CotizacionGeneral;
use App\Models\CotizacionViaticos;
use App\Models\Material;
use App\Models\MaterialReq;
use App\Models\Suministro;
use App\Models\ViaticosReq;
use App\Models\TipoMaterial;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RequisicionesController extends Controller
{
    public function index()
    {
        $requisiciones = Requisicion::with(['materialReqs.material', 'materialReqs.tipoMaterial', 'proyecto'])->get();
        //dd($requisiciones);
        return view('requisiciones.index', compact('requisiciones'));
    }

    public function create()
    {
        $proyectos = Proyecto::all();
        $materiales = Material::with(['unidadMedida', 'tipoMaterial'])->get(); // Carga las relaciones
        $tiposMateriales = TipoMaterial::all(); // Obtener los tipos de materiales

        return view('requisiciones.create', compact('proyectos', 'materiales', 'tiposMateriales'));
    }

    public function storeMateriales(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'Nombre_proyecto' => 'required|exists:proyectos,id',
            'Tipo_material' => 'required|array',
            'Material_id' => 'required|array',
            'UnidadMedida' => 'required|array',
            'Cantidad' => 'required|array|min:1',
        ]);

        //dd($request->all());
        $estatus = 0;

        // Crear la requisición con el ID del proyecto y la fecha actual
        $requisicion = Requisicion::create([
            'proyecto_id' => $request->Nombre_proyecto,  // ID del proyecto
            'fecha_solicitud' => Carbon::today()->toDateString(), // Fecha de hoy
            'estatus' => $estatus,  // Asignar el valor numérico a estatus
            'tipo' => 1,
        ]);

        // Insertar los materiales en la tabla material_req
        foreach ($request->Material_id as $index => $materialId) {
            MaterialReq::create([
                'fecha_solicitud' => Carbon::today()->toDateString(),
                'requisiciones_id' => $requisicion->id,
                'tipo_material' => $request->Tipo_material[$index],
                'material' => $materialId,
                'unidad_medida' => $request->UnidadMedida[$index],
                'cantidad' => $request->Cantidad[$index],
            ]);
        }

        // Redirigir al usuario después de crear la requisición
        return to_route('requisiciones.index')->with('status', 'Requisición creada exitosamente.');
    }

    public function storeViaticos(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'proyecto_id' => 'required|exists:proyectos,id',
            'Tipo_transporte' => 'nullable|array',
            'Origen' => 'nullable|array',
            'Destino' => 'nullable|array',
            'Fecha_salida' => 'nullable|array',
            'Lugar_hospedaje' => 'nullable|array',
            'Fecha_llegada' => 'nullable|array',
            'Fecha_salida_hospedaje' => 'nullable|array',
            'Numero_personas' => 'required|array',
        ]);

        $estatus = 0;

        $requisicion = Requisicion::create([
            'proyecto_id' => $request->proyecto_id,
            'fecha_solicitud' => Carbon::today()->toDateString(),
            'estatus' => $estatus,
            'tipo' => 2,
        ]);

        if ($request->Tipo_transporte) {
            foreach ($request->Tipo_transporte as $key => $tipo) {
                ViaticosReq::create([
                    'id_requisicion' => $requisicion->id,
                    'tipo' => 'Transporte',
                    'tipo_transporte' => $tipo,
                    'origen' => $request->Origen[$key],
                    'destino' => $request->Destino[$key],
                    'fecha_salida' => $request->Fecha_salida[$key],
                    'numero_personas' => $request->Numero_personas[$key],
                ]);
            }
        }

        if ($request->Lugar_hospedaje) {
            foreach ($request->Lugar_hospedaje as $key => $lugar) {
                ViaticosReq::create([
                    'id_requisicion' => $requisicion->id,
                    'tipo' => 'Hospedaje',
                    'lugar_hospedaje' => $lugar,
                    'fecha_llegada' => $request->Fecha_llegada[$key],
                    'fecha_salida_hospedaje' => $request->Fecha_salida_hospedaje[$key],
                    'numero_personas' => $request->Numero_personas[$key],
                ]);
            }
        }

        return redirect()->route('requisiciones.index')->with('success', 'Requisición de viáticos creada correctamente.');
    }

    public function mostrarAlmacen($id)
    {
        $requisicion = Requisicion::find($id);

        if ($requisicion->tipo == 2) {
            return redirect()->route('requisiciones.viaticos', $id);
        }

        $items = MaterialReq::where('requisiciones_id', $id)
            ->with(['material', 'unidadMedida', 'tipoMaterial'])
            ->get();
        //dd($items);

        //dd($materiales);
        return view('requisiciones.almacen', compact('requisicion', 'items'));
    }

    public function mostrarViaticos($id)
    {
        $requisicion = Requisicion::find($id);
        $items = ViaticosReq::where('id_requisicion', $id)
            ->get();

        //dd($items);

        return view('requisiciones.viaticos', compact('requisicion', 'items'));
    }

    public function autorizar(Request $request)
    {
        $requisicionesIds = $request->input('ids', []);

        foreach ($requisicionesIds as $id) {
            $requisicion = Requisicion::find($id);

            if ($requisicion) {
                $requisicion->estatus = 1; // Cambia el estatus a 'Autorizado'
                $requisicion->save();


                $cotizacion = new CotizacionGeneral();
                $cotizacion->id_requisicion = $requisicion->id;
                $cotizacion->fecha = now();
                $cotizacion->total = 0;
                $cotizacion->save();

                $cotizacionId = $cotizacion->id_cotizacion;

                foreach ($requisicion->items as $item) {
                    CotizacionViaticos::create([
                        'id_cotizacion' => $cotizacionId,
                        'id_proveedor' => 1,
                        'cantidad' => 0,
                        // 'personas' => $item->personas,
                        'precio_unitario' => 0,
                    ]);
                }
            }
        }

        return redirect()->route('requisiciones.index')->with('success', 'Requisición autorizada exitosamente.');
    }


    public function suministrar(Request $request, $id)
    {
        $requisicion = Requisicion::find($id);
        $requisicion->estatus = 1;

        $total = 0; // Variable para calcular el total general
        $necesitaCotizacion = false; // Bandera para determinar si se necesita una cotización

        foreach ($requisicion->materialReqs as $materialReq) {
            if ($materialReq->cantidad == $materialReq->cantidad_suministrada) {
                continue;
            }

            $material = $materialReq->Material;
            $cantidadSolicitada = $materialReq->cantidad;
            $cantidadSuministrada = 0;

            if ($material->Existencia >= $cantidadSolicitada - $materialReq->cantidad_suministrada) {
                $cantidadSuministrada = $cantidadSolicitada - $materialReq->cantidad_suministrada;
                $material->Existencia -= $cantidadSuministrada;
            } else {
                $cantidadSuministrada = $material->Existencia;
                $material->Existencia = 0;
                $necesitaCotizacion = true; // Se necesita cotización porque no se pudo suministrar completamente
            }

            $materialReq->cantidad_suministrada += $cantidadSuministrada;
            $materialReq->save();
            $material->save();

            Suministro::create([
                'requisicion_id' => $requisicion->id,
                'material_id' => $material->id,
                'cantidad_suministrada' => $cantidadSuministrada,
            ]);

            // Registrar en la tabla de cotizaciones_detalle si no se suministró completamente
            if ($cantidadSolicitada > $cantidadSuministrada) {
                if (!$necesitaCotizacion) {
                    $necesitaCotizacion = true; // Se necesita cotización porque no se pudo suministrar completamente
                }
            }
        }

        // Crear la cotización sólo si es necesario
        if ($necesitaCotizacion) {
            $cotizacion = new CotizacionGeneral();
            $cotizacion->id_requisicion = $requisicion->id;
            $cotizacion->fecha = now();
            $cotizacion->total = 0;
            $cotizacion->save();

            $cotizacionId = $cotizacion->id_cotizacion; // Obtener el ID de la cotización guardada

            foreach ($requisicion->materialReqs as $materialReq) {
                $cantidadSolicitada = $materialReq->cantidad;
                $cantidadSuministrada = $materialReq->cantidad_suministrada;

                if ($cantidadSolicitada > $cantidadSuministrada) {
                    CotizacionDetalle::create([
                        'id_cotizacion' => $cotizacionId,
                        'id_material' => $materialReq->Material->id,
                        'id_proveedor' => 1,
                        'cantidad' => $cantidadSolicitada - $cantidadSuministrada,
                        'precio_unitario' => 0,
                        'unidad_medida' => 'Pendiente',
                    ]);
                }
            }

            $cotizacion->total = $total;
            $cotizacion->save();
        }

        $requisicion->save();

        return redirect()->route('requisiciones.almacen', $requisicion->id)->with('success', 'Materiales suministrados exitosamente.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el registro por su ID
        $requisicion = Requisicion::findOrFail($id);

        // Eliminar el registro
        $requisicion->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('requisiciones.index')->with('warning', 'Requisición eliminada exitosamente.');
    }
}
