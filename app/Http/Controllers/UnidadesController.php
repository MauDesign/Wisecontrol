<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Unidades;
use Illuminate\Http\Request;

class UnidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unidades = Unidades::get();

        return view('unidades.index', ['unidades' => $unidades]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('unidades.create', ['unidades' => new Unidades()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Unidad_medidas' => 'required|string|max:255',
            'clave_unidad' => 'required|string|max:10',
        ], [
            'Unidad_medidas.required' => 'El campo "Unidad de medida" es obligatorio.',
            'clave_unidad.required' => 'El campo "Clave de unidad" es obligatorio.',
        ]);
    
        // Verificar si ya existe una unidad con los mismos valores
        $duplicate = Unidades::where('Unidad_medidas', $validatedData['Unidad_medidas'])
                              ->orWhere('clave_unidad', $validatedData['clave_unidad'])
                              ->first();
    
        if ($duplicate) {
            //return back()->withErrors(['warning' => 'Ya existe una unidad con los mismos valores.']);
            return to_route('unidades.create')->with('warning', 'Ya existe una unidad de medida con los mismos valores.');
        }
    
        Unidades::create($validatedData);
        return to_route('unidades.index')->with('success', 'Unidad de medida creada exitosamente.');
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
        $unidad = Unidades::findOrFail($id);
        return view('unidades.edit', ['unidades' => $unidad]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'Unidad_medidas' => 'required|string|max:255', // Campo obligatorio, tipo string, máximo 255 caracteres
            'clave_unidad' => 'required|string|max:10',   // Campo obligatorio, tipo string, máximo 50 caracteres
        ], [
            'Unidad_medidas.required' => 'El campo "Unidad de medida" es obligatorio.',
            'clave_unidad.required' => 'El campo "Clave de unidad" es obligatorio.',
        ]);

        $unidad = Unidades::findOrFail($id);
        $unidad->Unidad_medidas = $validatedData['Unidad_medidas'];
        $unidad->clave_unidad = $validatedData['clave_unidad'];
        $unidad->save();

        return redirect()->route('unidades.index')->with('success', 'Unidad de medida actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el registro por su ID
        $unidad = Unidades::findOrFail($id); // Reemplaza 'Unidad' con el nombre de tu modelo

        // Eliminar el registro
        $unidad->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('unidades.index')->with('warning', 'Unidad de medida eliminada exitosamente.');
    }
}
