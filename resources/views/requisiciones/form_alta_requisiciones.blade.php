<script>
    const materialesCatalogo = @json($materiales);
    const tiposMaterialesCatalogo = @json($tiposMateriales);
    console.log(materialesCatalogo);
    console.log(tiposMaterialesCatalogo);

    document.addEventListener('DOMContentLoaded', () => {
        const addMaterialBtn = document.getElementById('add-material-btn');
        const materialsTable = document.getElementById('materials-table').querySelector('tbody');

        addMaterialBtn.addEventListener('click', () => {
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
            <td>
                <div class="form-floating form-floating-outline form-floating-bootstrap-select">
                    <select name="Tipo_material[]" id="tipo-material" class="selectpicker w-100 tipo-material" data-live-search="true" data-style="btn btn-outline-secondary">
                        <option value="" disabled selected>Seleccione un tipo de material</option>
                        ${tiposMaterialesCatalogo.map(tipo => `<option value="${tipo.id}">${tipo.Tipo_material}</option>`).join('')}
                    </select>
                    <label>Tipo de Material</label>
                </div>
            </td>
            <td>
                <div class="form-floating form-floating-outline form-floating-bootstrap-select">
                    <select name="Material_id[]" id="material-select" class="selectpicker w-auto material-select" data-live-search="true" data-style="btn btn-outline-secondary">
                    </select>
                    <label>Material</label>
                </div>
            </td>
            <td>
                <input type="hidden" name="UnidadMedida[]" class="unidad-medida-id" />
                <input type="text" class="form-control unidad-medida-nombre" readonly />
            </td>
            <td>
                <input type="number" name="Cantidad[]" class="form-control" min="1" />
            </td>
            <td>
                <button type="button" class="btn btn-danger remove-row-btn">Eliminar</button>
            </td>
        `;

            materialsTable.appendChild(newRow);

            // Inicializar el selectpicker para que aplique el estilo de Bootstrap
            $(newRow.querySelectorAll('.selectpicker')).selectpicker('render');

            const tipoMaterialSelect = newRow.querySelector('#tipo-material');
            const materialSelect = newRow.querySelector('#material-select');
            const unidadMedidaIdInput = newRow.querySelector('.unidad-medida-id');
            const unidadMedidaNombreInput = newRow.querySelector('.unidad-medida-nombre');

            tipoMaterialSelect.addEventListener('change', () => {
                // Destruir el selectpicker antes de limpiar el contenido
                $(materialSelect).selectpicker('destroy');

                // Limpiar las opciones anteriores y la unidad de medida
                materialSelect.innerHTML = ''; // Limpiar el select de materiales
                unidadMedidaIdInput.value = ''; // Limpiar el campo oculto de ID de unidad de medida
                unidadMedidaNombreInput.value = ''; // Limpiar el campo visible de nombre de unidad de medida

                const tipoSeleccionado = tipoMaterialSelect.value;

                // Filtrar materiales por el tipo seleccionado
                const materialesFiltrados = materialesCatalogo.filter(material => material.tipo_material.id == tipoSeleccionado);

                // Agregar la opción "Seleccione un material" solo si no existe
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.disabled = true;
                defaultOption.selected = true;
                defaultOption.textContent = 'Seleccione un material';
                materialSelect.appendChild(defaultOption);

                // Agregar las nuevas opciones de materiales
                materialesFiltrados.forEach(material => {
                    const option = document.createElement('option');
                    option.value = material.id;
                    option.textContent = material.Material;
                    materialSelect.appendChild(option);
                });

                // Volver a inicializar el selectpicker para aplicar estilos
                $(materialSelect).selectpicker();
            });

            materialSelect.addEventListener('change', () => {
                const materialSeleccionado = materialesCatalogo.find(material => material.id == materialSelect.value);
                if (materialSeleccionado) {
                    unidadMedidaIdInput.value = materialSeleccionado.unidad_medida.id;
                    unidadMedidaNombreInput.value = materialSeleccionado.unidad_medida.Unidad_medidas;
                } else {
                    unidadMedidaIdInput.value = '';
                    unidadMedidaNombreInput.value = '';
                }
            });

            newRow.querySelector('.remove-row-btn').addEventListener('click', () => {
                newRow.remove();
            });
        });
    });
</script>




<div class="form-floating form-floating-outline form-floating-bootstrap-select mt-4">
    <select name="Nombre_proyecto" class="selectpicker w-100" data-live-search="true" data-style="btn btn-outline-secondary"
        id="proyect-name">
        <option value="" disabled selected>Seleccione un proyecto</option>
        @foreach ($proyectos as $proyecto)
            <option value="{{ $proyecto->id }}" {{ old('Nombre_proyecto') == $proyecto->id ? 'selected' : '' }}>
                {{ $proyecto->Nombre_proyecto }}
            </option>
        @endforeach
    </select>
    <label for="proyect-name">Nombre del Proyecto</label>
    <div class="proyect-nameHelp" class="form-text">
        @error('Nombre_proyecto')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>
</div>

<div class="form-floating form-floating-outline mt-4">
    <button type="button" id="add-material-btn" class="btn btn-primary">Agregar Material</button>
</div>

<table class="table mt-4" id="materials-table">
    <thead>
        <tr>
            <th>Tipo de Material</th>
            <th>Material</th>
            <th>Unidad de Medida</th>
            <th>Cantidad</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <!-- Filas dinámicas -->
    </tbody>
</table>
