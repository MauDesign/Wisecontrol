<?php

namespace App\Http\Controllers;

use App\Models\TipoMaterial;
use Illuminate\Http\Request;

class TipoMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipomaterial = TipoMaterial::get();

        return view('tipomaterial.index', ['tipomaterial' => $tipomaterial]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        return view('tipomaterial.create', ['tipomaterial' => new TipoMaterial()]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Tipo_material' => 'required|string|max:255', // Campo obligatorio, tipo string, máximo 255 caracteres
        ], [
            'Tipo_material' => 'El campo "Tipo Material" es obligatorio.',
        ]);

        TipoMaterial::create($validatedData);
        return to_route('tipomaterial.index')->with('success', 'Tipo de material creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $tipomaterial = TipoMaterial::findOrFail($id);
        return view('tipomaterial.edit', ['tipomaterial' => $tipomaterial]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'Tipo_material' => 'required|string|max:255', // Campo obligatorio, tipo string, máximo 255 caracteres
        ], [
            'Tipo_material' => 'El campo "Tipo Material" es obligatorio.',
        ]);

        $tipomaterial = TipoMaterial::findOrFail($id);
        $tipomaterial->Tipo_material = $validatedData['Tipo_material'];
        $tipomaterial->save();

        return redirect()->route('tipomaterial.index')->with('success', 'Tipo de material actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el registro por su ID
        $tipomaterial = TipoMaterial::findOrFail($id);

        // Eliminar el registro
        $tipomaterial->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('tipomaterial.index')->with('warning', 'Unidad de medida eliminada exitosamente.');
    }
}
