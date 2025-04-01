<x-app-layout>
    <div class="container card">
        <form action="{{ route('tipomaterial.update', $tipomaterial->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <h1>Editar Cliente</h1>

            <div>
                @include('tipomaterial.form_alta_tipomaterial', ['tipomaterial' => $tipomaterial])
            </div>
            <br>
            <div class="mb-4">
                <a href="{{ route('tipomaterial.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>

        </form>
    </div>
</x-app-layout>
