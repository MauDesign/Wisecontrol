<script>
    document.addEventListener('DOMContentLoaded', function() {
        var flatpickrDate = document.querySelector("#flatpickr-date");
        flatpickrDate.flatpickr({
            monthSelectorType: "static"
        });
    });
    $(document).ready(function() {
            $('.selectpicker').selectpicker();
        });
</script>

<div class="form-floating form-floating-outline">
    <input type="text" name="Nombre" class="form-control" id="Nombre" aria-describedby="Nombre"
        value="{{ old('Nombre', $proveedor->Nombre) }}" />
    <label for="Nombre">Nombre</label>
    <div class="NombreHelp" class="form-text">
        @error('Nombre')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="form-floating form-floating-outline mt-4">
    <input type="text" name="Correo" class="form-control" id="Correo" aria-describedby="Correo"
        value="{{ old('Correo', $proveedor->Correo) }}" />
    <label for="Correo">Correo</label>
    <div class="CorreoHelp" class="form-text">
        @error('Correo')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="form-floating form-floating-outline mt-4">
    <input type="number" name="Telefono" class="form-control" id="Telefono" aria-describedby="Telefono"
        value="{{ old('Telefono', $proveedor->Telefono) }}" />
    <label for="Telefono">Teléfono</label>
    <div class="TelefonoHelp" class="form-text">
        @error('Telefono')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="form-floating form-floating-outline mt-4">
    <input type="text" name="Direccion" class="form-control" id="Direccion" aria-describedby="Direccion"
        value="{{ old('Direccion', $proveedor->Direccion) }}" />
    <label for="Direccion">Dirección</label>
    <div class="DireccionHelp" class="form-text">
        @error('Direccion')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="form-floating form-floating-outline mt-4">
    <input type="text" name="RFC" class="form-control" id="RFC" aria-describedby="RFC"
        value="{{ old('RFC', $proveedor->RFC) }}" />
    <label for="RFC">RFC</label>
    <div class="RFCHelp" class="form-text">
        @error('RFC')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="form-floating form-floating-outline mt-4">
    <select name="Estado" class="form-control selectpicker" id="Estado" aria-describedby="Estatus"
        data-live-search="true">
        <option value="" disabled selected>Seleccione el estado</option>
        <option value="Aguascalientes">Aguascalientes</option>
        <option value="Baja California">Baja California</option>
        <option value="Baja California Sur">Baja California Sur</option>
        <option value="Campeche">Campeche</option>
        <option value="Chiapas">Chiapas</option>
        <option value="Chihuahua">Chihuahua</option>
        <option value="Ciudad de México">Ciudad de México</option>
        <option value="Coahuila">Coahuila</option>
        <option value="Colima">Colima</option>
        <option value="Durango">Durango</option>
        <option value="Estado de México">Estado de México</option>
        <option value="Guanajuato">Guanajuato</option>
        <option value="Guerrero">Guerrero</option>
        <option value="Hidalgo">Hidalgo</option>
        <option value="Jalisco">Jalisco</option>
        <option value="Michoacán">Michoacán</option>
        <option value="Morelos">Morelos</option>
        <option value="Nayarit">Nayarit</option>
        <option value="Nuevo León">Nuevo León</option>
        <option value="Oaxaca">Oaxaca</option>
        <option value="Puebla">Puebla</option>
        <option value="Querétaro">Querétaro</option>
        <option value="Quintana Roo">Quintana Roo</option>
        <option value="San Luis Potosí">San Luis Potosí</option>
        <option value="Sinaloa">Sinaloa</option>
        <option value="Sonora">Sonora</option>
        <option value="Tabasco">Tabasco</option>
        <option value="Tamaulipas">Tamaulipas</option>
        <option value="Tlaxcala">Tlaxcala</option>
        <option value="Veracruz">Veracruz</option>
        <option value="Yucatán">Yucatán</option>
        <option value="Zacatecas">Zacatecas</option>
    </select>
    <label for="Estado">Estado</label>
    <div class="EstadoHelp" class="form-text">
        @error('Estado')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="form-floating form-floating-outline mt-4">
    <select name="Estatus" class="form-control" id="Estatus" aria-describedby="Estatus">
        <option value="" disabled {{ old('Estatus', $proveedor->Estado) === null ? 'selected' : '' }}>Seleccione
            el estatus del proveedor</option>
        <option value="Activo" {{ old('Estatus', $proveedor->Estado) === 'Activo' ? 'selected' : '' }}>Activo</option>
        <option value="Inactivo" {{ old('Estatus', $proveedor->Estado) === 'Inactivo' ? 'selected' : '' }}>Inactivo
        </option>
    </select>
    <label for="Estatus">Estado</label>
    <div class="EstatusHelp" class="form-text">
        @error('Estatus')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>
</div>
