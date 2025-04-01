<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::get();

        return view('clientes.index', ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create',  ['cliente'=> new Cliente]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClienteRequest  $request)
    {

        $validatedData = $request->validate([
            'Nombre' => 'required|string|max:255',
            'Correo' => 'required|email|max:255',
            'Telefono' => 'required|string|max:15',
            'Direccion' => 'required|string|max:255',
            'RFC' => 'required|string|max:13',
            'CP' => 'required|string|max:13',
            'Regimen_fiscal' => 'required|string|max:10',
        ]);

        Cliente::create($validatedData);
        return to_route('clientes.index')->with('status', 'Cliente agregado');

    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        return view('clientes.show', ['cliente'=>$cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', ['cliente'=>$cliente]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClienteRequest $request, Cliente $cliente)
    {

        $cliente->update($request->validated());
        return to_route('clientes.index', $cliente)->with('status', 'cliente Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $clientes)
    {
        //
    }
}

