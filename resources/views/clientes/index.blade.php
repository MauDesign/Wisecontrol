
<x-app-layout>
    <div class="container card">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           Clientes
        </h2>
        <div class="filters align-content-end">
            <div class="col-m6"></div>
            <a href="{{route('clientes.create')}}" class="btn btn-primary" >Agregar</a>
        </div>
        <div class="card-datatable table-responsive pt-0 mt-4 mb-4">
            <table id="myTable" class="datatables-basic table table-bordered myTable  dt-responsive display nowrap">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Correo</td>
                        <td>Teléfono</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente )
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->Nombre}}</td>
                        <td>{{ $cliente->Correo }}</td>
                        <td>{{ $cliente->Telefono }}</td>
                        
                        <td><div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><span class="material-symbols-outlined">more_vert</span></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('clientes.edit', $cliente) }}"><span class="material-symbols-outlined">edit</span>Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);"><span class="material-symbols-outlined">delete</span> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
