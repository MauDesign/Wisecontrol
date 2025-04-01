<x-app-layout>
    <div class="container card pb-3">
        <div class="container">
            <div class="mt-4">
                <h3>Autorización de viáticos: {{ $requisicion->proyecto->Nombre_proyecto }}. Requisición:
                    {{ $requisicion->id }}</h3>
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
                <table id="myTable" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Tipo</td>
                            <td>Fecha inicio</td>
                            <td>Fecha fin</td>
                            <td>Noches</td>
                            <td># Personas</td>
                            {{-- <td>Estatus</td> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr data-id="{{ $item->id }}">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->tipo }}</td>
                                <td>{{ $item->fecha_inicial }}</td>
                                <td>{{ $item->fecha_final }}</td>
                                <td>{{ $item->noches ?? 'Sin asignar' }}</td>
                                <td>{{ $item->personas }}</td>
                                {{-- <td class="estatus">{{ $item->estatus }}</td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <form action="{{ route('requisiciones.autorizar') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ids[]" value="{{ $requisicion->id }}">
                    <div class="mt-4 mb-4">
                        <a href="{{ route('requisiciones.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary"
                            @if ($requisicion->estatus == 1) disabled @endif>
                            Autorizar viáticos
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
