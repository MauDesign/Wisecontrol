<script>
    $(document).ready(function() {
        // Inicializar todos los selectpicker al cargar la página
        $('.selectpicker').selectpicker();
    });
</script>

<div class="form-floating form-floating-outline">
    <input type="hidden" name="requisicion_id" value="{{ $requisicion->id }}">
</div>

@foreach ($detallesPorProveedor as $proveedorId => $detalles)
    @php
        $nombreProveedor = $proveedorId === 'Sin asignar' ? 'Sin asignar' : $detalles->first()->proveedor->Nombre;
    @endphp
    <h3>Proveedor: {{ $nombreProveedor }}</h3>
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>ID Material</th>
                <th>Unidad de Medida</th>
                <th>Proveedor</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalles as $detalle)
                <tr>
                    <td>{{ $detalle->material->Material }}</td>
                    <td>{{ $detalle->unidad_medida ?? 'N/A' }}</td>
                    @php
                        $nombreProveedorDetalle = $detalle->proveedor->Nombre ?? 'Sin asignar';
                    @endphp
                    <td>{{ $nombreProveedorDetalle }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>
                        <input type="number" name="precios_unitarios[{{ $detalle->id_detalle }}]" class="form-control"
                            step="0.01" min="0" value="{{ $detalle->precio_unitario }}" required>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach

