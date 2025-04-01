<x-app-layout>
    <div class="container card">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           Proyectos
        </h2>
        <div class="filters align-content-end">
            <div class="col-m6"></div>
            <a href="{{route('proyectos.create')}}" class="btn btn-primary" >Agregar</a>
        </div>
        @if (session('success'))
        <br>
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
        <div class="card-datatable pt-0 mt-4 mb-4">
            <div  class="table-responsive" style="width: 100%; overflow-x: hidden;">
                <table id="myTable" class="myTable  table table-bordered  dt-responsive display nowrap" cellspacing="0" style="width: 100%;">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nombre del Proyecto</td>
                            <td>Cliente</td>
                            <td>Presupuesto</td>
                            <td>Gastos</td>
                            <td>Fecha creacion</td>
                            <td>Responsable</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyectos as $proyecto )
                        <tr>
                            <td>{{ $proyecto->id }}</td>
                            <td><a href="{{ route('proyectos.show', $proyecto ) }}"> {{ $proyecto->Nombre_proyecto }}</a></td>
                            <td>{{ $proyecto->Cliente }}</td>
                            <td>{{ number_format($proyecto->Presupuesto, 2, '.', ',') }}</td>
                            <td>{{ number_format($proyecto->total_gastos, 2, '.', ',') }}</td>
                            <td>{{ $proyecto->Fecha_diseno }}</td>
                            <td>{{ $proyecto->Responsable }}</td>
                            <td><a type="" class="btn btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" href="{{route('proyectos.edit', $proyecto) }}"><span class="material-symbols-outlined">edit</span></a>
                                    <form action="{{ route('proyectos.destroy', $proyecto) }}" method="POST"
                                        style="display: inline;"
                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este proyecto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar">
                                            <span class="material-symbols-outlined">delete</span> 
                                        </button>
                                    </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
