<x-app-layout>
    <div class="container card">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Cátalogo de unidades de medida
        </h2>
        <div class="filters align-content-end">
            <div class="col-m6"></div>
            <a href="{{ route('unidades.create') }}" class="btn btn-primary">Agregar</a>
        </div>
        <div class="card-datatable table-responsive pt-0 mt-4 mb-4">
            <table class="datatables-basic table table-bordered">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Unidad de medida</td>
                        <td>Clave de unidad</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($unidades as $unidad)
                        <tr>
                            <td>{{ $unidad->id }}</td>
                            <td>{{ $unidad->Unidad_medidas }}</td>
                            <td>{{ $unidad->clave_unidad }}</td>

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><span
                                            class="material-symbols-outlined">more_vert</span></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('unidades.edit', $unidad->id) }}"><span
                                                class="material-symbols-outlined">edit</span>Editar</a>
                                        <form action="{{ route('unidades.destroy', $unidad->id) }}" method="POST"
                                            style="display: inline;"
                                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta unidad?');">
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
