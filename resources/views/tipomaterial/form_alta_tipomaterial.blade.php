<div class="form-floating form-floating-outline">
    <input type="text" name="Tipo_material" class="form-control" id="Tipo_material" aria-describedby="Tipo de Material" value="{{old('Tipo_material', $tipomaterial->Tipo_material)}}" />
    <label for="Tipo_material">Tipo de Material</label>
    <div class="Tipo_materialHelp" class="form-text">
        @error('Tipo_material')
        <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>
</div>