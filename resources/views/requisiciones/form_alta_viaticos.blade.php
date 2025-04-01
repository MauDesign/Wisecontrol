<script>
    document.addEventListener('DOMContentLoaded', () => {
        const addTransportBtn = document.getElementById('add-transport-btn');
        const transportTable = document.getElementById('transport-table').querySelector('tbody');

        addTransportBtn.addEventListener('click', () => {
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
                                <td>
                                    <select name="Tipo_transporte[]" class="form-control">
                                        <option value="" disabled selected>Seleccione tipo</option>
                                        <option value="Camión">Camión</option>
                                        <option value="Avión">Avión</option>
                                        <option value="Vehiculo">Vehículo utilitario</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="Origen[]" class="form-control" placeholder="Origen" />
                                </td>
                                <td>
                                    <input type="text" name="Destino[]" class="form-control" placeholder="Destino" />
                                </td>
                                <td>
                                    <input type="date" name="Fecha_salida[]" class="form-control" />
                                </td>
                                <td>
                                    <input type="number" name="Numero_personas[]" class="form-control" min="1" />
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger remove-row-btn">Eliminar</button>
                                </td>
                            `;
            transportTable.appendChild(newRow);

            flatpickr(newRow.querySelectorAll('.flatpickr-date'), {
                minDate: "today"
            });

            newRow.querySelector('.remove-row-btn').addEventListener('click', () => {
                newRow.remove();
            });
        });

        const addAccommodationBtn = document.getElementById('add-accommodation-btn');
        const accommodationTable = document.getElementById('accommodation-table').querySelector('tbody');

        addAccommodationBtn.addEventListener('click', () => {
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
                <td>
                    <input type="text" name="Lugar_hospedaje[]" class="form-control" placeholder="Lugar" />
                </td>
                <td>
                    <input type="date" name="Fecha_llegada[]" class="form-control" />
                </td>
                <td>
                    <input type="date" name="Fecha_salida_hospedaje[]" class="form-control" />
                </td>
                <td>
                    <input type="number" name="Numero_personas[]" class="form-control" min="1" />
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-row-btn">Eliminar</button>
                </td>
            `;

            accommodationTable.appendChild(newRow);

            flatpickr(newRow.querySelector('.flatpickr-date-initial'), {
                minDate: "today",
                onChange: function(selectedDates, dateStr, instance) {
                    const fechaSalidaInput = newRow.querySelector('.flatpickr-date-final');
                    flatpickr(fechaSalidaInput, {
                        minDate: dateStr
                    });
                }
            });

            flatpickr(newRow.querySelector('.flatpickr-date-final'), {});

            newRow.querySelector('.remove-row-btn').addEventListener('click', () => {
                newRow.remove();
            });
        });
        flatpickr(".flatpickr-date", {
            minDate: "today"
        });

        flatpickr(".flatpickr-date-initial", {
            minDate: "today",
            onChange: function(selectedDates, dateStr, instance) {
                const fechaSalidaInput = document.querySelector('.flatpickr-date-final');
                flatpickr(fechaSalidaInput, {
                    minDate: dateStr
                });
            }
        });

        flatpickr(".flatpickr-date-final", {});
    });
</script>

<div class="form-floating form-floating-outline mt-4">
    <select name="proyecto_id" class="form-control" id="proyect-name" aria-describedby="proyect-name">
        <option value="" disabled selected>Seleccione un proyecto</option>
        @foreach ($proyectos as $proyecto)
            <option value="{{ $proyecto->id }}" {{ old('proyecto_id') == $proyecto->id ? 'selected' : '' }}>
                {{ $proyecto->Nombre_proyecto }}
            </option>
        @endforeach
    </select>
    <label for="proyect-name">Nombre del Proyecto</label>
    <div class="proyect-nameHelp" class="form-text">
        @error('proyecto_id')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>
    <div class="mt-4">
        <h4>Transporte</h4>
        <button type="button" id="add-transport-btn" class="btn btn-primary">Agregar Transporte</button>
        <table class="table mt-4" id="transport-table">
            <thead>
                <tr>
                    <th>Tipo de Transporte</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Fecha de Salida</th>
                    <th>Número de Personas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Filas dinámicas -->
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <h4>Hospedaje</h4>
        <button type="button" id="add-accommodation-btn" class="btn btn-primary">Agregar Hospedaje</button>
        <table class="table mt-4" id="accommodation-table">
            <thead>
                <tr>
                    <th>Lugar</th>
                    <th>Fecha de Llegada</th>
                    <th>Fecha de Salida</th>
                    <th>Número de Personas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Filas dinámicas -->
            </tbody>
        </table>
    </div>
</div>
