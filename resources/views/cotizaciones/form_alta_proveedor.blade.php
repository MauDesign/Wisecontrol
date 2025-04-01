<script>
    $(document).ready(function() {
        // Inicializar todos los selectpicker al cargar la página
        $('.selectpicker').selectpicker();

    });
</script>

<div class="form-floating form-floating-outline">
    <input type="hidden" name="requisicion_id" value="{{ $requisicion->id }}">
</div>

<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Material</th>
            <th>Cantidad</th>
            <th>Unidad de medida</th>
            <th>Proveedor</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->Material->Material }}
                    <input type="hidden" name="materials[]" value="{{ $item->material }}">
                </td>
                <td>
                    <input type="text" name="cantidades[]" value="{{ $item->cantidad }}" class="form-control" readonly>
                </td>
                <td>
                    <input type="text" name="unidades[]"
                        value="{{ $item->unidadMedida->Unidad_medidas ?? 'Sin información' }}" class="form-control"
                        readonly>
                </td>
                <td>
                    <select name="proveedores[]" class="selectpicker w-100" data-live-search="true"
                        data-style="btn-outline-secondary" data-width="100%" required>
                        <option value="" disabled>Selecciona un proveedor</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}"
                                {{ $proveedor->id == old('id_proveedor', $item->id_proveedor ?? '') ? 'selected' : '' }}>
                                {{ $proveedor->Nombre }}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
