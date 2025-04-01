<x-app-layout>
    <div class="container card">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Cotizaciones
        </h2>
        <div class="filters align-content-end">
            <div class="col-m6"></div>
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
        <div class="card-datatable table-responsive text-nowrap pt-0 mt-4 mb-4">
            <table class="myTable table table-hover table-bordered  dt-responsive display nowrap">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Proyecto</td>
                        <td>Fecha solicitud</td>
                        <td>Materiales solicitados</td>
                        <td>Existencias en almacén</td>
                        <td>Tipo</td>
                        <td>Estatus</td>
                        {{-- <td>Acciones</td> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requisiciones as $requisicion)
                        <tr>
                            <td>{{ $requisicion->id }}</td>
                            <td><a href="{{ route('cotizaciones.create', $requisicion->id) }}">{{ $requisicion->proyecto->Nombre_proyecto }}</a></td>
                            <td>{{ $requisicion->fecha_solicitud }}</td>
                            <td>
                                @php
                                    $materialesContados = [];
                                @endphp

                                @foreach ($requisicion->materialReqs as $materialReq)
                                    @php
                                        // Contar cuántos elementos existen para cada material_id
                                        if (!isset($materialesContados[$materialReq->requisiciones_id])) {
                                            $materialesContados[$materialReq->requisiciones_id] = 0;
                                        }
                                        $materialesContados[$materialReq->requisiciones_id]++;
                                    @endphp
                                @endforeach

                                @foreach ($materialesContados as $materialId => $cantidad)
                                    {{ $cantidad }}
                                @endforeach
                            </td>
                            <td>Sin datos</td>
                            <td>
                                @if($requisicion->materialReqs && $requisicion->materialReqs->isNotEmpty())
                                    @php
                                        $tiposMaterial = [];
                                        foreach($requisicion->materialReqs as $materialReq) {
                                            if ($materialReq->tipoMaterial) {
                                                $tiposMaterial[] = $materialReq->tipoMaterial->Tipo_material;
                                            } else {
                                                $tiposMaterial[] = 'Sin Tipo';
                                            }
                                        }
                                    @endphp
                                    {{ implode(', ', $tiposMaterial) }}
                                @else
                                    Viáticos
                                @endif
                            </td>
                            <td>
                                @if ($requisicion->estatus == 0)
                                    <span class="badge rounded-pill bg-label-warning me-1">Pendiente</span>
                                @elseif ($requisicion->estatus == 1)
                                    <span class="badge rounded-pill bg-label-warning me-1">Cotizar</span>
                                @elseif ($requisicion->estatus == 2)
                                    <span class="badge rounded-pill bg-label-danger me-1">Rechazado</span>
                                @else
                                    <span class="badge rounded-pill bg-label-secondary me-1">Estado desconocido</span>
                                @endif
                            </td>
                            {{-- <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <span class="material-symbols-outlined">more_vert</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{ route('cotizaciones.create', $requisicion) }}">
                                            <span class="material-symbols-outlined">send</span> Cotizar
                                        </a>
                                        <a class="dropdown-item" href="{{ route('cotizaciones.edit', $requisicion) }}">
                                            <span class="material-symbols-outlined">edit</span> Editar
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0);">
                                            <span class="material-symbols-outlined">delete</span> Eliminar
                                        </a>
                                    </div>
                                </div>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
