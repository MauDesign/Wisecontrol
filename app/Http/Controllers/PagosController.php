<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use App\Models\CotizacionGeneral;
use App\Models\Pagos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagosController extends Controller
{
    public function index()
    {
        // Cargamos: cotizacion ➜ detalles ➜ proveedor
        $pagos = Pagos::with('cotizacion.detalles.proveedor')
            ->where('forma_pago', 'Contado')
            ->get();
    
        $pagosProgramados = Pagos::with('cotizacion.detalles.proveedor')
            ->where('forma_pago', 'Por pagar')
            ->get();
    
        // Si también necesitas cotizaciones:
        $cotizaciones = CotizacionGeneral::with('detalles', 'requisicion.proyecto')->get();
    
        return view('pagos.index', compact('cotizaciones', 'pagos', 'pagosProgramados'));
    }
    
    
        

    public function store(Request $request)
    {
        $request->validate([
            'monto' => 'required|numeric',
            'fecha' => 'required|date',
            'tipo_pago' => 'required|string',
            'forma_pago' => 'required|string',
            'cotizacion_id' => 'required|numeric',
        ]);

        $pago = new Pagos();
        $pago->id_cotizacion = $request->cotizacion_id;
        $pago->id_proveedor = $request->id_proveedor;
        $pago->monto = $request->monto;
        $pago->fecha = $request->fecha;
        $pago->tipo_pago = $request->tipo_pago;
        $pago->forma_pago = $request->forma_pago;
        $pago->save();

        // Verificar si la suma de los pagos es igual al monto total de la cotización
        $cotizacion = CotizacionGeneral::findOrFail($request->cotizacion_id);
        $sumaPagos = $cotizacion->pagos()->sum('monto');

        if ($sumaPagos >= $cotizacion->total) {
            $cotizacion->estado = 3;
            $cotizacion->save();
        }

        return redirect()->back()->with('success', 'Pago registrado correctamente.');
    }

    public function updateFormaPago(Request $request)
    {
        // Validar que se hayan seleccionado ítems
        $request->validate([
            'selected_ids' => 'required|array',
            'selected_ids.*' => 'exists:pagos,id',
        ]);

        // Actualizar la forma de pago a "Contado" para los ítems seleccionados
        Pagos::whereIn('id', $request->selected_ids)->update(['forma_pago' => 'Contado']);

        // Redireccionar con un mensaje de éxito
        return redirect()->back()->with('success', 'Forma de pago actualizada exitosamente.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $pagoProgramado = Pagos::where('forma_pago', 'Por pagar')->findOrFail($id);
        return view('pagos.edit', compact('pagoProgramado'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'nota' => 'string',
        ]);

        $pagoProgramado = Pagos::findOrFail($id);
        $pagoProgramado->fecha = $request->input('fecha');
        $pagoProgramado->nota = $request->input('nota');
        $pagoProgramado->save();



        return redirect()->route('pagos.index')->with('success', 'Pago actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
