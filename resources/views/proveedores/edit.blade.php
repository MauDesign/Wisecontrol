<x-app-layout>
    <div class="container card">
        <form action="{{ route('proveedores.update', $proveedor->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <h1>Editar Proveedor</h1>

            <div>
                @include('proveedores.form_alta_proveedores', ['proveedor' => $proveedor])
            </div>
            <br>
            <div class="mb-4">
                <a href="{{ route('proveedores.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>

        </form>
    </div>
</x-app-layout>
