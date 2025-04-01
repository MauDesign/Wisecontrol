<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProveedorRequest;
use App\Http\Requests\UpdateProveedorRequest;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::get();

        return view('proveedores.index', ['proveedores' => $proveedores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('proveedores.create',  ['proveedor' => new Proveedor]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProveedorRequest $request)
    {
        //dd(request()->all()); // Esto mostrará todos los datos enviados desde el formulario
        $validatedData = $request->validate([
            'Nombre' => 'required|string|max:255',
            'Correo' => 'required|email|max:255',
            'Telefono' => 'required|string|max:15',
            'Direccion' => 'required|string|max:255',
            'RFC' => 'required|string|max:13',
            'Estado' => 'required|string|max:50',
            'Estatus' => 'required|in:Activo,Inactivo',
        ]);

        Proveedor::create($validatedData);
        return to_route('proveedores.index')->with('status', 'Proveedor agregado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        //$proveedor = Proveedor::all();
        return view('proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProveedorRequest $request, Proveedor $proveedor)
    {
        // Validar los datos enviados desde el formulario
        $request->validate([
            'Nombre' => 'required|string|max:255',
            'Correo' => 'required|email|max:255',
            'Telefono' => 'required|string|max:15',
            'Direccion' => 'required|string|max:255',
            'RFC' => 'required|string|max:13',
            'Estado' => 'required|string',
            'Estatus' => 'required|in:Activo,Inactivo',
        ]);

        // Actualizar los datos del proveedor en la base de datos
        $proveedor->update([
            'Nombre' => $request->Nombre,
            'Correo' => $request->Correo,
            'Telefono' => $request->Telefono,
            'Direccion' => $request->Direccion,
            'RFC' => $request->RFC,
            'Estado' => $request->Estado,
            'Estatus' => $request->Estatus,
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        // Eliminar el proveedor
        $proveedor->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado correctamente.');
    }
}
