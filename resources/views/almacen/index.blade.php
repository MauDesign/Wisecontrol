<x-app-layout>
    <div class="container card">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Almacén
        </h2>
        <div class="filters align-content-end">
            <div class="col-m6"></div>
            <a href="{{ route('almacen.create') }}" class="btn btn-primary">Agregar Material</a>
        </div>
        <div class="card-datatable table-responsive pt-0 mt-4 mb-4">
            <table id="myTable" class="datatables-basic table table-bordered myTable  dt-responsive display nowrap" cellspacing="0" style="width: 100%;">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Material</td>
                        <td>Existencia</td>
                        <td>Unidad de medida</td>
                        <td>Tipo de material</td>
                        <td>Acciones</td>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($materials as $material)
                        <tr>
                            <td>{{ $material->id }}</td>
                            <td>{{ $material->Material }}</td>
                            <td>{{ $material->Existencia }}</td>
                            <td>{{ $material->unidadMedida->Unidad_medidas ?? 'Sin unidad' }}</td>
                            <td>{{ $material->tipoMaterial->Tipo_material ?? 'No asignado' }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><span
                                            class="material-symbols-outlined">more_vert</span></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('almacen.edit', $material) }}"><span
                                                class="material-symbols-outlined">edit</span>Editar</a>
                                        <form action="{{ route('almacen.destroy', $material->id) }}" method="POST"
                                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este proveedor?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">
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
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

</x-app-layout>
