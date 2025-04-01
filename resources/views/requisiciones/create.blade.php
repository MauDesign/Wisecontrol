<x-app-layout>
<div class="container card pb-3">
    <h1>Agregar nueva requisición</h1>
<div class="nav-align-top">
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">Materiales</button>
    </li>
    <li class="nav-item">
      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">Viáticos</button>
    </li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
        <form action="{{ route('requisiciones.materiales.store') }}" method="POST">
            @csrf
           <h2>Materiales</h2> 

            @include('requisiciones.form_alta_requisiciones')
            <div class="mt-4 align-content-end">
                <a href="{{route('requisiciones.index')}}"  class="btn btn-outline-secondary" >Cancelar</a>
                <button type="submit" class="btn btn-primary">Agregar requisición</button>
            </div>
        </form> 
    </div>
    <div class="tab-pane fade show " id="navs-top-profile" role="tabpanel">
        <form action="{{ route('requisiciones.viaticos.store') }}" method="POST">
            @csrf
            <h2>Viáticos</h2>
            @include('requisiciones.form_alta_viaticos')
            <div class="mt-4 align-content-end">
                <a href="{{route('requisiciones.index')}}"  class="btn btn-outline-secondary" >Cancelar</a>
                <button type="submit" class="btn btn-primary">Agregar requisición</button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>