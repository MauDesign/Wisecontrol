<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\CatMedida;
use App\Models\TipoMaterial;
use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialsRequest;

use Illuminate\Http\Request;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = Material::with(['unidadMedida', 'tipoMaterial'])->get(); // Carga las relaciones
        //dd($materials->toArray());
        return view('almacen.index', compact('materials'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unidad_medidas = CatMedida::all();
        $tipo_materials = TipoMaterial::all();
        return view('almacen.create', [
            'material' => new Material,
            'unidad_medidas' => $unidad_medidas,
            'tipo_materials' => $tipo_materials
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaterialsRequest $request)
    {
        Material::create($request->validated());


        return to_route('almacen.index')->with('status', 'Material agregado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        return view('almacen.show', ['material' => $material]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        $unidad_medidas = CatMedida::all();
        $tipo_materials = TipoMaterial::all();

        return view('almacen.edit', [
            'material' => $material,
            'unidad_medidas' => $unidad_medidas,
            'tipo_materials' => $tipo_materials
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        // Validar los datos recibidos del formulario
        $validatedData = $request->validate([
            'Material' => 'required|string|max:255',
            'Existencia' => 'required|numeric|min:0',
            'Unidad_medida' => 'required|exists:cat_medidas,id', // Verifica que exista en la tabla relacionada
            'Tipo_material' => 'required|exists:tipo_materials,id', // Verifica que exista en la tabla relacionada
        ]);


        // Actualizar el modelo con los nuevos valores
        $material->update([
            'Material' => $validatedData['Material'],
            'Existencia' => $validatedData['Existencia'],
            'Unidad_medida' => $validatedData['Unidad_medida'], // ID de la unidad
            'Tipo_material' => $validatedData['Tipo_material'], // ID del tipo de material
        ]);


        // Redirigir con un mensaje de éxito
        return redirect()->route('almacen.index')->with('success', 'Material actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        $material->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('almacen.index')->with('warning', 'Material eliminado correctamente.');
    }
}
