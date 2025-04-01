<x-app-layout>
<div class="container card pb-3">
    <form action="{{ route('proyectos.store') }}" method="POST">
        @csrf
        <h1>Agregar proyecto</h1>

        @include('proyectos.form_alta_proyectos')
        <div class="mt-4 align-content-end">
            <a href="{{route('proyectos.index')}}"  class="btn btn-outline-secondary" >Cancel</a>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
    </form>
</div>
</x-app-layout>

