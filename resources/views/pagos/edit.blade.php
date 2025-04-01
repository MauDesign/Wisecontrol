<x-app-layout>
    <div class="container card card-body demo-vertical-spacing demo-only-element">
        <h1>Editar Fecha del Pago Programado</h1>

        <form action="{{ route('pagos.update', $pagoProgramado->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-floating form-floating-outline mb-3">
                <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="fecha" id="flatpickr-date" value="{{ $pagoProgramado->fecha }}" required/>
                <label for="flatpickr-date">Date Picker</label>
            </div>
            <div class="form-floating form-floating-outline mb-3">
                <textarea class="form-control h-px-75" aria-label="With textarea" name="nota" placeholder="Ingresar nota"></textarea>
                <label>Nota de reprogramación de pago:</label>
            </div>
            <button type="submit" class="btn btn-primary mt-4 mb-4">Actualizar Fecha</button>
        </form>
    </div>
    <script>
        var flatpickrDate = document.querySelector("#flatpickr-date");

        flatpickrDate.flatpickr({
            monthSelectorType: "static"
        });
    </script>
</x-app-layout>

