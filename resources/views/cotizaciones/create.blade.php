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
                    <form action="{{ route('enviar.a.pago') }}" method="POST">
                        @csrf
                        <div class="text-end">
                            <button type="button" class="btn btn-danger btn-sm">Crear PDF</button>
                            <button type="submit" class="btn btn-success btn-sm">Enviar a Pago</button>
                        </div>
                        @foreach ($cotizacionesGenerales as $cotizacionGeneral)
                            <div class="mt-4">
                                <h3>
                                    Cotización: {{ $cotizacionGeneral->id_cotizacion }}
                                </h3>
                                <input type="checkbox" name="cotizaciones[]" class="form-check-input"
                                    value="{{ $cotizacionGeneral->id_cotizacion }}"
                                    id="cotizacion-{{ $cotizacionGeneral->id_cotizacion }}">
                                <label class="form-check-label" for="cotizacion-{{ $cotizacionGeneral->id_cotizacion }}">Seleccionar
                                    cotización</label>
                            </div>

                            @php
                                $detallesPorProveedor = $cotizacionGeneral->detalles->groupBy('id_proveedor');
                            @endphp

                            @foreach ($detallesPorProveedor as $proveedor => $detalles)
                                <h4>Proveedor: {{ $detalles->first()->proveedor->Nombre ?? 'Sin información' }}</h4>
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
                                        @foreach ($detalles as $detalle)
                                            <tr>
                                                <td>{{ $detalle->material->Material }}</td>
                                                <td>{{ $detalle->cantidad }}</td>
                                                <td>${{ number_format($detalle->precio_unitario, 2, '.', ',') }}</td>
                                                <td>${{ number_format($detalle->subtotal, 2, '.', ',') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        @endforeach
                    </form>
                </div>

                <div class="tab-pane fade" id="navs-pills-top-suppliers" role="tabpanel">
                    <div>
                        <form action="{{ route('cotizaciones.proveedor', $requisicion->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <h2>Seleccionar proveedores</h2>
                            @if (session('warning'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ session('warning') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @include('cotizaciones.form_alta_proveedor')

                            <div class="mt-4 align-content-end">
                                <a href="{{ route('cotizaciones.index') }}"
                                    class="btn btn-outline-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Asignar proveedores</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-top-costs" role="tabpanel">
                    <div>
                        <form action="{{ route('cotizaciones.update', $requisicion) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <h2>Asignar costos</h2>

                            @if (session('warning'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ session('warning') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @include('cotizaciones.form_alta_costos')

                            <div class="mt-4 align-content-end">
                                <a href="{{ route('cotizaciones.index') }}"
                                    class="btn btn-outline-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Asignar costos</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
