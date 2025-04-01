<x-app-layout>
    <div class="container card">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Requisiciones
        </h2>
        <div class="filters align-content-end">
            <div class="col-m6"></div>
            <a href="{{ route('requisiciones.create') }}" class="btn btn-primary">Nueva requisición</a>
        </div>
        <div class="card-datatable table-responsive text-nowrap pt-0 mt-4 mb-4">
            <table id="myTable" class="table table-hover table-bordered myTable  dt-responsive display nowrap" cellspacing="0" style="width: 100%;">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Proyecto</td>
                        <td>Fecha solicitud</td>
                        <td>Materiales solicitados</td>
                        <td>Existencias en almacén</td>
                        <td>Tipo</td>
                        <td>Estatus</td>
                        {{-- <td>Autorización</td> --}}
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requisiciones as $requisicion)
                        <tr>
                            <td>{{ $requisicion->id }}</td>
                            <td><a
                                    href="{{ route('requisiciones.almacen', $requisicion->id) }}">{{ $requisicion->proyecto->Nombre_proyecto }}</a>
                            </td>
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

                                @if (empty($materialesContados))
                                    Viáticos
                                @else
                                    @foreach ($materialesContados as $materialId => $cantidad)
                                        @if ($cantidad != 0)
                                            {{ $cantidad }}
                                        @else
                                            Viáticos
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if ($requisicion->materialReqs && $requisicion->materialReqs->isNotEmpty())
                                    @php
                                        $totalSolicitados = 0;
                                        $totalSuministrables = 0;
                                        foreach ($requisicion->materialReqs as $materialReq) {
                                            if ($materialReq->Material) {
                                                $existencia = $materialReq->Material->Existencia ?? 0;
                                                $cantidadSolicitada = $materialReq->cantidad;

                                                $totalSolicitados++;
                                                if ($existencia >= $cantidadSolicitada) {
                                                    $totalSuministrables++;
                                                }
                                            }
                                        }
                                    @endphp
                                    {{ $totalSuministrables }}/{{ $totalSolicitados }}
                                @else
                                    No Aplica
                                @endif
                            </td>
                            <td>
                                @if ($requisicion->materialReqs && $requisicion->materialReqs->isNotEmpty())
                                    @php
                                        $tiposMaterial = [];
                                        foreach ($requisicion->materialReqs as $materialReq) {
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
                                @if ($requisicion->estatus === 1)
                                    <span class="badge rounded-pill bg-label-success me-1">Autorizado</span>
                                @else
                                    <span class="badge rounded-pill bg-label-warning me-1">Pendiente</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <span class="material-symbols-outlined">more_vert</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <form action="{{ route('requisiciones.destroy', $requisicion) }}" method="POST"
                                            style="display: inline;"
                                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta requisición?');">
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
    </div>
</x-app-layout>
