<x-app-layout>
    <div class="container card">

        <div class="nav-align-top mt-4">
            <ul class="nav nav-pills mb-4" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-top-quotes" aria-controls="navs-pills-top-quotes"
                        aria-selected="true">Cotizaciones</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-top-suppliers" aria-controls="navs-pills-top-suppliers"
                        aria-selected="false">Asignar proveedor</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-top-costs" aria-controls="navs-pills-top-costs"
                        aria-selected="false">Asignar costos</button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-pills-top-quotes" role="tabpanel">
                    {{-- <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalles de la Cotización
        </h2> --}}

                    {{-- <h3>Requisición ID: {{ $requisicion->id }}</h3> --}}

                    @foreach ($cotizacionesGenerales as $cotizacionGeneral)
                        <h3>Cotización: {{ $cotizacionGeneral->id_cotizacion }}</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID Material</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cotizacionGeneral->detalles as $detalle)
                                    <tr>
                                        <td>{{ $detalle->id_detalle }}</td>
                                        <td>{{ $detalle->cantidad }}</td>
                                        <td>{{ $detalle->precio_unitario }}</td>
                                        <td>{{ $detalle->subtotal }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach


                    <h3>Materiales Relacionados</h3>
                    <table class="table mb-4">
                        <thead>
                            <tr>
                                <th>Material</th>
                                <th>Unidad</th>
                                <th>Tipo</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->material }}</td>
                                    <td>{{ $item->unidad_medida }}</td>
                                    <td>{{ $item->tipoMaterial->Tipo_material }}</td>
                                    <td>{{ $item->cantidad }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="tab-pane fade" id="navs-pills-top-suppliers" role="tabpanel">
                    <div>
                        <form action="{{ route('cotizaciones.store', $requisicion) }}" method="POST">
                            @csrf
                            <h2>Seleccionar proveedores</h2>
                            @if (session('warning'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ session('warning') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @include('cotizaciones.form_alta_proveedor')
                        </form>
                        <div class="mt-4 align-content-end">
                            <a href="{{ route('cotizaciones.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Asignar proveedores</button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-top-costs" role="tabpanel">
                    <div>
                        <form action="{{ route('cotizaciones.store', $requisicion) }}" method="POST">
                            @csrf
                            <h2>Asignar costos</h2>
                            @if (session('warning'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ session('warning') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @include('cotizaciones.form_alta_costos')
                        </form>
                        <div class="mt-4 align-content-end">
                            <a href="{{ route('cotizaciones.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Asignar costos</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
