<x-app-layout>
<div class="container card pb-3">
    <form action="{{ route('unidades.store') }}" method="POST">
        @csrf
        <h1>Agregar unidades de medida</h1>
        
        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @include('unidades.form_alta_unidades')
        <div class="mt-4 align-content-end">
            <a href="{{route('unidades.index')}}"  class="btn btn-outline-secondary" >Cancelar</a>
            <button type="submit" class="btn btn-primary">Agregar unidad de medida</button>
        </div>
    </form>
</div>
</x-app-layout>

