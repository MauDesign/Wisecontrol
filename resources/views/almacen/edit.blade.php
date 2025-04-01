<x-app-layout>
    <div class="container card">
        <form action="{{ route('almacen.update', $material->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <h1>Editar Cliente</h1>

            <div>
                @include('almacen.form_alta_materials', ['almacen' => $material])
            </div>
            <br>
            <div class="mb-4">
                <a href="{{ route('almacen.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>

        </form>
    </div>
</x-app-layout>