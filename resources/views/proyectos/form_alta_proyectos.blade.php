<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#Fecha_diseno", {
            monthSelectorType: "static"
        });
        flatpickr("#Fecha_obra", {
            monthSelectorType: "static"
        });
        flatpickr("#Fecha_fin", {
            monthSelectorType: "static"
        });
    });

    $(document).ready(function() {
        $('.selectpicker').selectpicker({
            style: 'btn-info',
            size: 4
        });  
    });
</script>

<div class="form-floating form-floating-outline">
    <input type="text" name="Nombre_proyecto" class="form-control" id="proyect-name" aria-describedby="proyect-name"
        value="{{ old('Nombre_proyecto', $proyecto->Nombre_proyecto) }}" />
    <label for="proyect-name">Nombre</label>
    <div class="proyect-nameHelp" class="form-text">
        @error('Nombre_proyecto')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>
</div>

<div class="form-floating form-floating-outline form-floating-bootstrap-select mt-4">
    <select id="Cliente" name="Cliente"  class="selectpicker w-100" data-live-search="true" data-style="btn btn-outline-secondary" data-header="Escribe el nombre del cliente y seleccionalo">
        @foreach ($clientes as $cliente)
            <option data-tokens="{{ $cliente->Nombre }}" value="{{ $cliente->Nombre }}" {{ old('Cliente') == $cliente->Nombre ? 'selected' : '' }}>
                {{ $cliente->Nombre }}</option>
        @endforeach
    </select>
    <label for="Cliente">Cliente</label>
    <div class="ClienteHelp form-text">
        @error('Cliente')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>
</div>

<div class="form-floating form-floating-outline mt-4">
    <input type="text" name="Presupuesto" class="form-control" id="Presupuesto" aria-describedby="proyect-name"
        value="{{ old('Presupuesto', $proyecto->Presupuesto) }}" />
    <label for="Presupuesto">Presupuesto</label>
    <div class="PresupuestoHelp" class="form-text">
        @error('Presupuesto')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="form-floating form-floating-outline mt-4">
    <input id="Fecha_diseno" name="Fecha_diseno" class="form-control" type="text"
        value="{{ old('Fecha_diseno', $proyecto->Fecha_diseno) }}" style="z-index: 1110;"> </input>
    <label for="Fecha_diseno"> Fecha Diseño</label>
    <div id="Fecha_disenoHelp" class="form-text">
        @error('Fecha_diseno')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="form-floating form-floating-outline mt-4">
    <input id="Fecha_obra" name="Fecha_obra" class="form-control" type="text"
        value="{{ old('Fecha_obra', $proyecto->Fecha_obra) }}" style="z-index: 1110;"> </input>
    <label for="Fecha_obra"> Fecha Obra</label>
    <div id="Fecha_obraHelp" class="form-text">
        @error('Fecha_obra')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="form-floating form-floating-outline mt-4">
    <input id="Fecha_fin" name="Fecha_fin" class="form-control" type="text"
        value="{{ old('Fecha_fin', $proyecto->Fecha_fin) }}" style="z-index: 1110;"> </input>
    <label for="Fecha_fin"> Fecha Fin</label>
    <div id="Fecha_finHelp" class="form-text">
        @error('Fecha_fin')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="form-floating form-floating-outline form-floating-bootstrap-select mt-4">
    <select name="Responsable"class="selectpicker w-100" data-live-search="true" data-style="btn btn-outline-secondary" multiple data-tick-icon="ri-check-line text-white" id="Responsable" data-header="Escribe el nombre del responsable  y seleccionalo">
        @foreach ($usuarios as $usuario)
            <option data-tokens="{{ $usuario->name }}" value="{{ $usuario->name }}" 
                {{ old('Responsable', $proyecto->Responsable) == $usuario->name ? 'selected' : '' }}>
                {{ $usuario->name }}
            </option>
        @endforeach
    </select>
    <label for="Responsable">Responsable de obra</label>
    <div class="ResponsableHelp" class="form-text">
        @error('Responsable')
            <small style="color:red;">{{ $message }}</small>
        @enderror
    </div>
</div>

