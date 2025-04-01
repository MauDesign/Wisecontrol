<x-app-layout>
    <div class="container card">
        <form action="{{ route('proyectos.update', $proyecto) }}" method="POST">
            @csrf @method('PATCH')

            <h1>Agregar proyecto</h1>

            @include('proyectos.form_alta_proyectos')
            <div class="mt-4 mb-4">
                <a href="{{ route('proyectos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
        </form>
    </div>
</x-app-layout>
