<div class="form-floating form-floating-outline">
    <input type="text" name="Unidad_medidas" class="form-control" id="Unidad_medidas" placeholder="Ingresa la unidad de medida" aria-describedby="Unidad_medidas" value="{{old('Unidad_medidas', $unidades->Unidad_medidas)}}" />
    <label for="Unidad_medidas">Unidad de medida</label>
    <div class="Unidad_medidasHelp" class="form-text">
        @error('Unidad_medidas')
        <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="form-floating form-floating-outline mt-4">
    <input type="text" name="clave_unidad" class="form-control" placeholder="Ingresa la abreviatura de la unidad de medida" id="clave_unidad" aria-describedby="Clave de la unidad de medida" value="{{old('clave_unidad', $unidades->clave_unidad)}}" />
    <label for="clave_unidad">Clave de unidad</label>
    <div class="clave_unidadHelp" class="form-text">
        @error('clave_unidad')
        <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>
</div>

