<script>

    $(document).ready(function() {
        $('.selectpicker').selectpicker({
            style: 'btn-info',
            size: 4
        });  
    });
</script>
    <div class="form-floating form-floating-outline">
        <input type="text" name="Nombre" class="form-control" id="cliente-name" aria-describedby="cliente-name" value="{{old('Nombre', $cliente->Nombre)}}" />
        <label for="cliente-name">Nombre</label>
        <div class="cliente-nameHelp" class="form-text">
            @error('Nombre')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-floating form-floating-outline mt-4">
        <input type="text" name="Correo" class="form-control" id="correo" aria-describedby="Correo" value="{{old('Correo', $cliente->Correo)}}" />
        <label for="correo">Correo</label>
        <div class="correoHelp" class="form-text">
            @error('Correo')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-floating form-floating-outline mt-4">
        <input type="text" name="Telefono" class="form-control" id="Tel" aria-describedby="Tel" value="{{old('Telefono', $cliente->Telefono)}}" />
        <label for="Tel">Teléfono</label>
        <div class="TelHelp" class="form-text">
            @error('Telefono')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-floating form-floating-outline mt-4">
        <input type="text" name="Direccion" class="form-control" id="Direccion" aria-describedby="Direccion" value="{{old('Direccion', $cliente->Direccion)}}" />
        <label for="Direccion">Dirección</label>
        <div class="DireccionHelp" class="form-text">
            @error('Direccion')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-floating form-floating-outline mt-4">
        <input type="text" name="RFC" class="form-control" id="RFC" aria-describedby="RFC" value="{{old('RFC', $cliente->RFC)}}" />
        <label for="RFC">RFC</label>
        <div class="RFCHelp" class="form-text">
            @error('RFC')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div> 
    <div class="form-floating form-floating-outline mt-4">
        <input type="text" name="CP" class="form-control" id="CP" aria-describedby="CP" value="{{old('CP', $cliente->CP)}}" />
        <label for="CP">CP</label>
        <div class="CPHelp" class="form-text">
            @error('CP')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-floating form-floating-outline form-floating-bootstrap-select mt-4">
        <select name="Regimen_fiscal" class="selectpicker w-100" data-live-search="true" data-style="btn btn-outline-secondary" multiple data-tick-icon="ri-check-line text-white" id="Responsable" data-header="Escribe el nombre del regimen  y seleccionalo" id="Regimen_fiscal" >
            <option value="" disabled selected>Selecciona un régimen fiscal</option>
            <option value="603" {{ old('Regimen_fiscal', $cliente->Regimen_fiscal) == '603' ? 'selected' : '' }}>603 - Personas Morales</option>
            <option value="616" {{ old('Regimen_fiscal', $cliente->Regimen_fiscal) == '616' ? 'selected' : '' }}>616 - Actividades Empresariales y Profesionales</option>
            <option value="621" {{ old('Regimen_fiscal', $cliente->Regimen_fiscal) == '621' ? 'selected' : '' }}>621 - Régimen de Sueldos y Salarios</option>
            <option value="622" {{ old('Regimen_fiscal', $cliente->Regimen_fiscal) == '622' ? 'selected' : '' }}>622 - Régimen de Arrendamiento</option>
            <option value="624" {{ old('Regimen_fiscal', $cliente->Regimen_fiscal) == '624' ? 'selected' : '' }}>624 - Personas Morales con Fines no Lucrativos</option>
            <option value="625" {{ old('Regimen_fiscal', $cliente->Regimen_fiscal) == '625' ? 'selected' : '' }}>625 - Régimen Simplificado de Confianza</option>
            <option value="628" {{ old('Regimen_fiscal', $cliente->Regimen_fiscal) == '628' ? 'selected' : '' }}>628 - Cooperativas</option>
            <option value="629" {{ old('Regimen_fiscal', $cliente->Regimen_fiscal) == '629' ? 'selected' : '' }}>629 - Régimen de Incorporación Fiscal</option>
        </select>
        <label for="Regimen_fiscal">Régimen Fiscal</label>
        <div class="Regimen_fiscalHelp" class="form-text">
            @error('Regimen_fiscal')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    
    
    
    

