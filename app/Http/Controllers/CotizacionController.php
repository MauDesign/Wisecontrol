<?php

namespace App\Http\Controllers;

use App\Models\CotizacionDetalle;
use App\Models\CotizacionGeneral;
use App\Models\MaterialReq;
use App\Models\Requisicion;
use App\Models\Proveedor;
use App\Models\ViaticosReq;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CotizacionController extends Controller
{
    public function index()
    {
        $requisiciones = Requisicion::with(['materialReqs', 'proyecto'])
            ->where('estatus', 1)
            ->get();

        return view('cotizaciones.index', compact('requisiciones'));
    }

    public function create($id)
    {
        // Buscar la requisición por ID
        $requisicion = Requisicion::findOrFail($id);

        // Obtener todas las cotizaciones generales relacionadas con la requisición, junto con sus detalles
        $cotizacionesGenerales = CotizacionGeneral::where('id_requisicion', $id)
            ->with(['detalles', 'detalles.proveedor', 'viaticos']) // Carga los detalles relacionados con cada cotización general
            ->get();

        //dd($cotizacionesGenerales);

        // Agrupar los detalles por proveedor, incluyendo aquellos sin proveedor asignado
        $detallesPorProveedor = collect();
        foreach ($cotizacionesGenerales as $cotizacion) {
            foreach ($cotizacion->detalles as $detalle) {
                $proveedorId = $detalle->proveedor->id ?? 'Sin asignar';
                if (!isset($detallesPorProveedor[$proveedorId])) {
                    $detallesPorProveedor[$proveedorId] = collect();
                }
                $detallesPorProveedor[$proveedorId]->push($detalle);
            }
        }

        // Obtener los materiales relacionados con la requisición
        $items = MaterialReq::where('requisiciones_id', $id)
            ->with(['material', 'unidadMedida', 'tipoMaterial'])
            ->get();
        //dd($items);

        $viaticos = ViaticosReq::where('id_requisicion', $id)->get();

        $proveedores = Proveedor::all();

        //dd($cotizacionesGenerales);

        return view('cotizaciones.create', compact('requisicion', 'cotizacionesGenerales', 'detallesPorProveedor', 'items', 'viaticos', 'proveedores'));
    }

    public function store(Request $request, $id_requisicion)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'materials' => 'required|array',
            'materials.*' => 'required|string',
            'cantidades' => 'required|array',
            'cantidades.*' => 'required|numeric|min:0',
            'unidades' => 'required|array',
            'unidades.*' => 'required|string',
            'proveedores' => 'required|array',
            'proveedores.*' => 'required|integer|exists:proveedors,id',
        ]);

        // Crear un nuevo registro en cotizaciones_general
        $cotizacion = new CotizacionGeneral();
        $cotizacion->id_requisicion = $id_requisicion;
        $cotizacion->fecha = now();
        $cotizacion->total = 0;
        $cotizacion->save();

        $total = 0; // Variable para calcular el total general

        // Crear registros en cotizaciones_detalle
        foreach ($request->materials as $index => $material) {
            if (isset($request->cantidades[$index], $request->unidades[$index], $request->proveedores[$index])) {
                // Calcular subtotal como ejemplo
                $subtotal = 0;

                CotizacionDetalle::create([
                    'id_cotizacion' => $cotizacion->id_cotizacion,
                    'id_material' => $material,
                    'id_proveedor' => $request->proveedores[$index],
                    'cantidad' => $request->cantidades[$index],
                    'precio_unitario' => 0,
                    'unidad_medida' => $request->unidades[$index],
                    'proveedor_id' => $request->proveedores[$index],
                ]);

                // Incrementar el total general
                $total += $subtotal;
            }
        }

        // Actualizar el total en cotizaciones_general
        $cotizacion->total = $total;
        $cotizacion->save();

        // Redirigir o devolver una respuesta
        return redirect()->route('cotizaciones.index')
            ->with('success', 'Cotización creada exitosamente.');
    }


    public function show(string $id) {}

    public function edit(string $id)
    {
        $requisicion = Requisicion::findOrFail($id);

        // Obtener todas las cotizaciones generales relacionadas con la requisición, junto con sus detalles
        $cotizacionesGenerales = CotizacionGeneral::where('id_requisicion', $id)
            ->with('detalles.proveedor') // Carga los detalles relacionados con cada cotización general
            ->get();

        // Depuración para verificar los datos
        // dd($cotizacionesDetalles);

        return view('cotizaciones.create', compact('requisicion', 'cotizacionesGenerales'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos recibidos
        $validated = $request->validate([
            'precios_unitarios' => 'required|array',
            'precios_unitarios.*' => 'required|numeric|min:0',
        ]);

        // Buscar la cotización general
        $cotizacion = CotizacionGeneral::where('id_requisicion', $id)->firstOrFail();

        $total = 0;

        // Actualizar cada detalle de la cotización
        foreach ($request->precios_unitarios as $id_detalle => $precio_unitario) {
            // Buscar el detalle específico
            $detalle = CotizacionDetalle::findOrFail($id_detalle);

            // Actualizar el precio unitario
            $detalle->precio_unitario = $precio_unitario;
            $detalle->save();

            // Sumar al total general
            $total += $detalle->cantidad * $precio_unitario;
        }

        // Actualizar el total en cotizaciones_general
        $cotizacion->total = $total;
        $cotizacion->save();

        return redirect()->route('cotizaciones.index')
            ->with('success', 'Costos actualizados exitosamente.');
    }

    public function updateProvider(Request $request, $id)
    {
        // Buscar la requisición por ID
        $requisicion = Requisicion::findOrFail($id);

        // Validar y actualizar la información de la requisición
        $requisicion->update($request->all());

        // Obtener todas las cotizaciones generales relacionadas con la requisición
        $cotizacionesGenerales = CotizacionGeneral::where('id_requisicion', $id)->get();

        // Actualizar el proveedor en cada detalle de la cotización
        foreach ($cotizacionesGenerales as $cotizacion) {
            foreach ($cotizacion->detalles as $index => $detalle) {
                // Verificar si el proveedor actual es "Sin asignar"
                if ($detalle->id_proveedor == 1) {
                    // Si se selecciona un nuevo proveedor, actualizar el dato
                    $detalle->id_proveedor = $request->proveedores[$index];
                    $detalle->save();
                } elseif ($detalle->id_proveedor != 1 && $detalle->id_proveedor != $request->proveedores[$index]) {
                    // Si ya tenía un proveedor diferente de "Sin asignar", crear una nueva cotización
                    $nuevaCotizacion = CotizacionGeneral::create([
                        'id_requisicion' => $id,
                        'fecha' => Carbon::today()->toDateString(),
                        'total' => 0,
                        'estado' => 0,
                    ]);

                    if ($nuevaCotizacion) {
                        CotizacionDetalle::create([
                            'id_cotizacion' => $nuevaCotizacion->id_cotizacion,
                            'id_material' => $request->materials[$index],
                            'id_proveedor' => $request->proveedores[$index],
                            'cantidad' => $request->cantidades[$index],
                            'precio_unitario' => 0,
                            'unidad_medida' => $request->unidades[$index],
                            'proveedor_id' => $request->proveedores[$index],
                        ]);
                    }
                }
            }
        }

        $detallesPorProveedor = collect();
        foreach ($cotizacionesGenerales as $cotizacion) {
            foreach ($cotizacion->detalles as $detalle) {
                $proveedorId = $detalle->proveedor->id ?? 'Sin asignar';
                if (!isset($detallesPorProveedor[$proveedorId])) {
                    $detallesPorProveedor[$proveedorId] = collect();
                }
                $detallesPorProveedor[$proveedorId]->push($detalle);
            }
        }

        // Obtener los materiales relacionados con la requisición
        $items = MaterialReq::where('requisiciones_id', $id)
            ->with(['material', 'unidadMedida', 'tipoMaterial'])
            ->get();
        //dd($items);

        $viaticos = ViaticosReq::where('id_requisicion', $id)->get();

        $proveedores = Proveedor::all();

        // Retornar la vista de creación con los datos necesarios
        return view('cotizaciones.create', compact('requisicion', 'cotizacionesGenerales', 'detallesPorProveedor', 'items', 'viaticos', 'proveedores'))->with('success', 'Proveedor actualizado correctamente');
    }




    public function cambiarEstado(Request $request, $id)
    {
        // Lógica para cambiar el estado de la cotización
        $cotizacion = CotizacionGeneral::findOrFail($id);
        $cotizacion->estado = $request->input('estado'); // Asegúrate de enviar el estado en la solicitud
        $cotizacion->save();

        return response()->json(['message' => 'Estado actualizado correctamente'], 200);
    }


    public function enviarAPago(Request $request)
    {
        // Validar que se hayan seleccionado cotizaciones
        $request->validate([
            'cotizaciones' => 'required|array',
            'cotizaciones.*' => 'exists:cotizaciones_general,id_cotizacion',
        ]);

        // Obtener los IDs de las cotizaciones seleccionadas
        $cotizacionesIds = $request->input('cotizaciones');

        // Actualizar el estado de las cotizaciones seleccionadas
        CotizacionGeneral::whereIn('id_cotizacion', $cotizacionesIds)->update(['estado' => 1]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('cotizaciones.index')->with('success', 'Las cotizaciones seleccionadas han sido enviadas a pago.');
    }

    public function destroy(string $id)
    {
        //
    }
}
