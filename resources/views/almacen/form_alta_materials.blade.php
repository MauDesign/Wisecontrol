@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div> @endif @if ($errors->has('duplicado'))
        <div class="alert alert-warning"> {{ $errors->first('duplicado') }} </div>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var flatpickrDate = document.querySelector("#flatpickr-date");
            flatpickrDate.flatpickr({
                monthSelectorType: "static"
            });
        })
    </script>

    <div class="form-floating form-floating-outline">
        <input type="text" name="Material" class="form-control" id="Material" aria-describedby="Material"
            value="{{ old('Material', $material->Material) }}" />
        <label for="Material">Material</label>
        <div class="MaterialHelp" class="form-text">
            @error('Material')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-floating form-floating-outline mt-4">
        <input type="text" name="Existencia" class="form-control" id="Existencia" aria-describedby="proyect-name"
            value="{{ old('Existencia', $material->Existencia) }}" />
        <label for="Existencia">Existencias</label>
        <div class="ExistenciaHelp" class="form-text">
            @error('Existencia')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-floating form-floating-outline mt-4">
        <select id="Unidad_medida" name="Unidad_medida" class="select2 form-select form-select-lg">
            <option value="">Selecciona una unidad de medida</option>
            @foreach ($unidad_medidas as $medida)
                <option value="{{ $medida->id }}"
                    {{ old('Unidad_medida', $material->Unidad_medida) == $medida->id ? 'selected' : '' }}>
                    {{ $medida->Unidad_medidas }}
                </option>
            @endforeach
        </select>
        <label for="Unidad_medida">Unidad de medida</label>
        <div class="Unidad_medidaHelp" class="form-text">
            @error('Unidad_medida')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-floating form-floating-outline mt-4">
        <select id="Tipo_material" name="Tipo_material" class="select2 form-select form-select-lg">
            <option value="">Selecciona un tipo de material</option>
            @foreach ($tipo_materials as $tipo_material)
                <option value="{{ $tipo_material->id }}"
                    {{ old('Tipo_Material', $material->Tipo_Material) == $tipo_material->id ? 'selected' : '' }}>
                    {{ $tipo_material->Tipo_material }}
                </option>
            @endforeach
        </select>
        <label for="Tipo_material">Tipo de Material</label>
        <div class="Tipo_materialHelp" class="form-text">
            @error('Tipo_material')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
