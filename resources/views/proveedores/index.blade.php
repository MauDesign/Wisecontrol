<x-app-layout>
    <div class="container card">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           Proveedores
        </h2>
        <div class="filters align-content-end">
            <div class="col-m6"></div>
            <a href="{{route('proveedores.create')}}" class="btn btn-primary" >Agregar</a>
        </div>
        <div class="card-datatable table-responsive pt-0 mt-4 mb-4">
            <table id="myTable" class="datatables-basic table table-bordered  dt-responsive display nowrap">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Correo</td>
                        <td>Teléfono</td>
                        <td>Dirección</td>
                        <td>Estado</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedores as $proveedor )
                    <tr>
                        <td>{{ $proveedor->id }}</td>
                        <td>{{ $proveedor->Nombre}}</td>
                        <td>{{ $proveedor->Correo }}</td>
                        <td>{{ $proveedor->Telefono }}</td>
                        <td>{{ $proveedor->Direccion }}</td>
                        <td>{{ $proveedor->Estado }}</td>
                        <td><div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><span class="material-symbols-outlined">more_vert</span></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('proveedores.edit', $proveedor) }}">
                                    <span class="material-symbols-outlined">edit</span> Editar
                                </a>
                                <form action="{{ route('proveedores.destroy', $proveedor) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este proveedor?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item" >
                                        <span class="material-symbols-outlined">delete</span> Borrar
                                    </button>
                                </form>
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
