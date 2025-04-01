<x-app-layout>
<div class="container card pb-3">
    <form action="{{ route('clientes.store') }}"  method="POST">
        @csrf
        
        <h1>Agregar cliente</h1>
        @include('clientes.form_alta_clientes')
        <div class="mt-4 align-content-end">
            <a href="{{route('clientes.index')}}"  class="btn btn-outline-secondary" >Cancelar</a>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
    </form>
</div>
</x-app-layout>

