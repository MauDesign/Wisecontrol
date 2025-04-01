<x-app-layout>
    <div class="container card">
        <form action="{{ route('unidades.update', $unidades->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <h1>Editar Cliente</h1>

            <div>
                @include('unidades.form_alta_unidades', ['unidades' => $unidades])
            </div>
            <br>
            <div class="mb-4">
                <a href="{{ route('unidades.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>

        </form>
    </div>
</x-app-layout>