<x-app-layout>
<div class="container card">
    <form action="{{ route('clientes.update', $cliente) }}" method="POST">
        @csrf @method('PATCH')

        <h1>Edita Cliente</h1>

        @include('clientes.form_alta_clientes')

        <a href="{{route('clientes.index')}}"  class="btn btn-outline-secondary" >Cancel</a>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
</x-app-layout>
