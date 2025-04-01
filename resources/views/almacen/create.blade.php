<x-app-layout>
<div class="container card pb-3">
    <form action="{{ route('almacen.store') }}" method="POST">
        @csrf
        <h1>Agregar Material</h1>

        @include('almacen.form_alta_materials')
        <div class="mt-4 align-content-end">
            <a href="{{route('almacen.index')}}"  class="btn btn-outline-secondary" >Cancelar</a>
            <button type="submit" class="btn btn-primary">Agregar Material</button>
        </div>
    </form>
</div>
</x-app-layout>

