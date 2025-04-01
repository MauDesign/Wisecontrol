<x-app-layout>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const items = @json($items);
            const submitButton = document.getElementById('submitButton');

            // Función para verificar si todos los items están suministrados
            function checkItems() {
                let allSuministrados = true;

                items.forEach(item => {
                    if (item.cantidad !== item.cantidad_suministrada) {
                        allSuministrados = false;
                    }
                });

                submitButton.disabled = allSuministrados;
            }

            checkItems();
        });
    </script>

    <div class="container card pb-3">
        <div class="container">
            <div class="mt-4">
                <h3>Suministrar materiales para: {{ $requisicion->proyecto->Nombre_proyecto }}. Requisición: {{ $requisicion->id }}</h3>

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

            <form method="POST" action="{{ route('requisiciones.suministrar', $requisicion->id) }}">
                @csrf

                @if ($items->isEmpty())
                    <p>No hay materiales para mostrar</p>
                @else
                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th>Material</th>
                                <th>Cantidad Solicitada</th>
                                <th>Cantidad Suministrada</th>
                                <th>Existencias en almacén</th>
                                <th>Acciones a realizar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->Material->Material }}</td>
                                    <td>{{ $item->cantidad }}</td>
                                    <td>{{ $item->cantidad_suministrada }}</td>
                                    <td>{{ $item->Material->Existencia }}</td>
                                    <td>
                                        @if ($item->cantidad == $item->cantidad_suministrada)
                                            <span class="badge rounded-pill bg-label-success me-1">Material
                                                suministrado</span>
                                        @elseif ($item->Material->Existencia == 0 || $item->Material->Existencia == null)
                                            <span class="badge rounded-pill bg-label-danger me-1">Sin suministro
                                                necesario cotizar</span>
                                        @elseif ($item->cantidad <= $item->Material->Existencia && $item->cantidad > 0)
                                            <span class="badge rounded-pill bg-label-success me-1">Suministrar
                                                completamente</span>
                                        @elseif ($item->cantidad > $item->Material->Existencia)
                                            <span class="badge rounded-pill bg-label-warning me-1">Suministrar
                                                parcialmente y cotizar faltante</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <div class="mt-4 mb-4">
                    <a href="{{ route('requisiciones.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary" id="submitButton">Autorizar Acciones</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
