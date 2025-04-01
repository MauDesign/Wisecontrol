<x-app-layout>
    <div class="container card pb-3">
        <form action="{{ route('tipomaterial.store') }}" method="POST">
            @csrf
            <h1>Agregar Tipos de Material</h1>

            @include('tipomaterial.form_alta_tipomaterial')
            <div class="mt-4 align-content-end">
                <a href="{{ route('unidades.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Agregar Tipo de Material</button>
            </div>
        </form>
    </div>
</x-app-layout>
