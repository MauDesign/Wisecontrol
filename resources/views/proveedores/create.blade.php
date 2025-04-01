<x-app-layout>
<div class="container card pb-3">
    <form action="{{ route('proveedores.store') }}" method="POST">
        @csrf
        <h1>Agregar proveedor</h1>

        @include('proveedores.form_alta_proveedores')
        <div class="mt-4 align-content-end">
            <a href="{{route('proveedores.index')}}"  class="btn btn-outline-secondary" >Cancelar</a>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
    </form>
</div>
</x-app-layout>

