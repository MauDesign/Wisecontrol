<x-app-layout>
    <div class="container card">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Pagos
        </h2>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="autorizaciones-tab" data-bs-toggle="tab"
                    data-bs-target="#autorizaciones" type="button" role="tab" aria-controls="autorizaciones"
                    aria-selected="true">Por autorizar</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="cotizaciones-tab" data-bs-toggle="tab" data-bs-target="#cotizaciones"
                    type="button" role="tab" aria-controls="cotizaciones" aria-selected="true">Por pagar</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pagos-tab" data-bs-toggle="tab" data-bs-target="#pagos" type="button"
                    role="tab" aria-controls="pagos" aria-selected="false">Pagos Realizados</button>
            </li>
            <!-- Nueva pestaña para Pagos Programados -->
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pagos-programados-tab" data-bs-toggle="tab"
                    data-bs-target="#pagos-programados" type="button" role="tab" aria-controls="pagos-programados"
                    aria-selected="false">Pagos Programados</button>
            </li>
        </ul>
        <!-- Tab content -->
        <div class="tab-content" id="myTabContent">
            <!-- Autorización Tab -->
            <div class="tab-pane fade show active" id="autorizaciones" role="tabpanel"
                aria-labelledby="autorizaciones-tab">
                <div class="card-datatable table-responsive text-nowrap pt-0 mt-4 mb-4" style="overflow-x: hidden;">
                    <table id="myTable" class="table table-hover table-bordered myTable  dt-responsive display nowrap" style="width: 100%;" >
                        <thead>
                            <tr>
                                <td>ID Cotización</td>
                                <td>Proyecto</td>
                                <td>Fecha y hora de solicitud</td>
                                <td>Total</td>
                                <td>Estatus</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cotizaciones as $cotizacion)
                                @if ($cotizacion->estado == 1)
                                    <tr>
                                        <td>{{ $cotizacion->id_cotizacion }}</td>
                                        <td>{{ optional($cotizacion->requisicion->proyecto)->Nombre_proyecto ?? 'Sin dato aún' }}</td>
                                        <td>{{ $cotizacion->fecha }}</td>
                                        <td>$ {{ number_format($cotizacion->total, 2, '.', ',') }}</td>
                                        <td>
                                            @if ($cotizacion->estado == 1)
                                                Por autorizar
                                            @else
                                                {{ $cotizacion->estado }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <span class="material-symbols-outlined">more_vert</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button class="btn cambiar-estado"
                                                        data-id="{{ $cotizacion->id_cotizacion }}">
                                                        <span class="material-symbols-outlined">check_circle</span>
                                                        Cambiar Estado
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="cotizaciones" role="tabpanel" aria-labelledby="cotizaciones-tab">
                <div class="card-datatable table-responsive text-nowrap pt-0 mt-4 mb-4" style="overflow-x: hidden;">
                    <table id="myTable1" class="table table-hover table-bordered myTable  dt-responsive display nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <td>ID Cotización</td>
                                <td>Proyecto</td>
                                <td>Fecha y hora de solicitud</td>
                                <td>Total</td>
                                <td>Estatus</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cotizaciones as $cotizacion)
                                @if ($cotizacion->estado == 2)
                                    <tr>
                                        <td>{{ $cotizacion->id_cotizacion }}</td>
                                        <td>{{ optional($cotizacion->requisicion->proyecto)->Nombre_proyecto ?? 'Sin dato aún' }}</td>
                                        <td>{{ $cotizacion->fecha }}</td>
                                        <td>$ {{ number_format($cotizacion->total, 2, '.', ',') }}</td>
                                        <td>Aprobada</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <span class="material-symbols-outlined">more_vert</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#modalPago"
                                                        data-total="{{ $cotizacion->total }}">
                                                        <span class="material-symbols-outlined">payment</span> Registrar
                                                        Pago
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagos Realizados Tab -->
            <div class="tab-pane fade" id="pagos" role="tabpanel" aria-labelledby="pagos-tab">
                <div class="card-datatable table-responsive text-nowrap pt-0 mt-4 mb-4" style="overflow-x: hidden;">
                    <!-- Total de pagos -->
                    <div class="mb-3">
                        <strong>Total de pagos: </strong>
                        <span id="totalPagos">$ 0.00</span>
                    </div>

                    <!-- Filtro de fechas -->
                    <div class="d-flex mb-3">
                        <div class="col-4 p-1">                            
                            <label for="fechaInicio">Fecha de inicio:</label>
                            <input type="date" id="fechaInicio" class="form-control">
                        </div>
                        <div class="col-4 p-1">
                            <label for="fechaFin">Fecha de fin:</label>
                            <input type="date" id="fechaFin" class="form-control">
                        </div>
                        <button id="filtrar" class="btn btn-primary mt-2 p-2">Filtrar</button>
                        <button id="quitarFiltros" class="btn btn-secondary mt-2 p-2">Quitar filtros</button>
                    </div>

                    <!-- Tabla de pagos -->
                    <table id="myTable2" class="table table-hover table-bordered myTable  dt-responsive display nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <td>ID Pago</td>
                                <td>ID Cotización</td>
                                <td>ID Proveedor</td>
                                <td>Monto</td>
                                <td>Tipo de Pago</td>
                                <td>Forma de Pago</td>
                                <td>Fecha</td>
                                <td>Estatus</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pagos as $pago)
                                <tr>
                                    <td>{{ $pago->id }}</td>
                                    <td>{{ $pago->id_cotizacion }}</td>
                                    <!-- Extracción del id y nombre del proveedor desde el primer detalle -->
                                    @php
                                        $detalle = $pago->cotizacion->detalles->first();
                                    @endphp
                                    <td>
                                        <input type="hidden" name="id_proveedor" value="{{ optional($detalle)->id_proveedor }}">
                                        {{ optional($detalle->proveedor)->Nombre ?? 'Sin proveedor' }}
                                    </td>
                                    <td class="monto">$ {{ number_format($pago->monto, 2, '.', ',') }}</td>
                                    <td>{{ $pago->tipo_pago }}</td>
                                    <td>{{ $pago->forma_pago }}</td>
                                    <td class="fecha">{{ $pago->fecha }}</td>
                                    <td>Pagado</td>
                                </tr>
                            @endforeach
                        </tbody>                                               
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="pagos-programados" role="tabpanel"
                aria-labelledby="pagos-programados-tab">
                <form id="updateForm" action="{{ route('pagos.updateFormaPago') }}" method="POST">
                    @csrf
                    <div class="card-datatable table-responsive text-nowrap pt-0 mt-4 mb-4" style="overflow-x: hidden;">
                        <table id="myTable3" class="table table-hover table-bordered myTable  dt-responsive display nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" class="form-check-input" id="selectAll"> Selección
                                    </td>
                                    <td>ID Pago</td>
                                    <td>ID Cotización</td>
                                    <td>ID Proveedor</td>
                                    <td>Monto</td>
                                    <td>Tipo de Pago</td>
                                    <td>Forma de Pago</td>
                                    <td>Fecha Programada</td>
                                    <td>Estatus</td>
                                    <td>Acciones</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pagosProgramados as $pagoProgramado)
                                    <tr>
                                        <td><input type="checkbox" class="select-item form-check-input"
                                                name="selected_ids[]" value="{{ $pagoProgramado->id }}"></td>
                                        <td>{{ $pagoProgramado->id }}</td>
                                        <td>{{ $pagoProgramado->id_cotizacion }}</td>
                                        <td>{{ $pagoProgramado->id_proveedor }}</td>
                                        <td>$ {{ number_format($pagoProgramado->monto, 2, '.', ',') }}</td>
                                        <td>{{ $pagoProgramado->tipo_pago }}</td>
                                        <td>{{ $pagoProgramado->forma_pago }}</td>
                                        <td>{{ $pagoProgramado->fecha }}</td>
                                        <td>Programado</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><span
                                                        class="material-symbols-outlined">more_vert</span></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('pagos.edit', $pagoProgramado) }}"><span
                                                            class="material-symbols-outlined">calendar_today</span>
                                                        Reprogramar pago</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary">Cambiar a Contado</button>
                </form>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalPago" tabindex="-1" aria-labelledby="modalPagoLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalPagoLabel">Registrar Pago</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formRegistrarPago" action="{{ route('pagos.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_proveedor" value="{{ optional($pago->cotizacion->detalles->first())->id_proveedor }}">
                                <div class="d-flex ">
                                    <div class="col-6 mb-3">
                                        <label for="monto" class="form-label">Monto del Pago</label>
                                        <input type="number" name="monto" class="form-control" id="monto"
                                            readonly>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="fecha" class="form-label">Fecha del Pago</label>
                                        <input type="date" name="fecha" class="form-control" id="fecha"
                                            required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="tipo_pago" class="form-label">Tipo de Pago</label>
                                    <select name="tipo_pago" class="form-control" id="tipo_pago" required>
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Transferencia">Transferencia</option>
                                        <option value="Cheque">Cheque</option>
                                        <option value="Tarjeta">Tarjeta</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="forma_pago" class="form-label">Forma de Pago</label>
                                    <select name="forma_pago" class="form-control" id="forma_pago" required>
                                        <option value="Contado">Contado</option>
                                        <option value="Crédito">Crédito</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="cotizacion_id" class="form-label">ID Cotización</label>
                                    <input type="number" name="cotizacion_id" class="form-control"
                                        id="cotizacion_id" required readonly>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar Pago</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        $('#modalPago').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var cotizacionId = button.closest('tr').find('td:first')
                .text(); // Obtén el ID de la cotización
            var total = button.data('total'); // Obtén el total de la cotización

            var modal = $(this);
            modal.find('.modal-body #cotizacion_id').val(
                cotizacionId); // Actualiza el ID de la cotización
            modal.find('.modal-body #monto').val(total); // Actualiza el monto del pago
        });

        $('#formRegistrarPago').on('submit', function(event) {
            var fechaPago = new Date($('#fecha').val());
            var fechaActual = new Date();
            var estadoPago = "";

            if (fechaPago <= fechaActual) {
                estadoPago = "Pagado";
            } else {
                estadoPago = "Por pagar";
            }

            var inputEstadoPago = $('<input>').attr({
                type: 'hidden',
                id: 'estado_pago',
                name: 'estado_pago',
                value: estadoPago
            });

            $(this).append(inputEstadoPago);
        });

        $('#fecha').on('change', function() {
            var fechaPago = new Date($(this).val());
            var fechaActual = new Date();
            var estadoPago = "";

            if (fechaPago <= fechaActual) {
                estadoPago = "Pagado";
            } else {
                estadoPago = "Por pagar";
            }

            $('#forma_pago').empty();
            $('#forma_pago').append('<option value="' + estadoPago + '">' + estadoPago + '</option>');
        });

        $(document).ready(function() {
            $('.cambiar-estado').on('click', function() {
                let id = $(this).data('id');
                if (id) {
                    cambiarEstado(id);
                } else {
                    alert('ID no válido.');
                }
            });
        });

        function cambiarEstado(id) {
            console.log('ID recibido:', id);
            $.ajax({
                url: `/cotizaciones/${id}/estado`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    estado: 2
                },
                success: function(response) {
                    alert(response.message);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.log('Detalles del error:', xhr.responseText);
                    alert('Error al cambiar el estado.');
                }

            });
        }

        document.getElementById('selectAll').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('.select-item');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = document.getElementById('selectAll').checked;
            });
        });

    });

    document.addEventListener("DOMContentLoaded", function() {
        calcularTotal();
    });

    function calcularTotal() {
        const montos = document.querySelectorAll(".monto");
        let total = 0;

        montos.forEach((monto) => {
            const valor = parseFloat(monto.textContent.replace("$", "").replace(/,/g, ""));
            total += valor;
        });

        document.getElementById("totalPagos").textContent =
            `$ ${total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`;
    }

    document.getElementById("filtrar").addEventListener("click", function() {
        const fechaInicio = document.getElementById("fechaInicio").value;
        const fechaFin = document.getElementById("fechaFin").value;
        const filas = document.querySelectorAll("#myTable2 tbody tr");
        let totalFiltrado = 0;

        filas.forEach((fila) => {
            const fechaPago = fila.querySelector(".fecha").textContent;
            const monto = parseFloat(fila.querySelector(".monto").textContent.replace("$", "").replace(
                /,/g, ""));

            if (
                (!fechaInicio || fechaPago >= fechaInicio) &&
                (!fechaFin || fechaPago <= fechaFin)
            ) {
                fila.style.display = "";
                totalFiltrado += monto;
            } else {
                fila.style.display = "none";
            }
        });

        document.getElementById("totalPagos").textContent =
            `$ ${totalFiltrado.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`;
    });

    document.getElementById("quitarFiltros").addEventListener("click", function() {
        document.getElementById("fechaInicio").value = "";
        document.getElementById("fechaFin").value = "";

        const filas = document.querySelectorAll("#myTable2 tbody tr");
        filas.forEach((fila) => {
            fila.style.display = "";
        });

        calcularTotal();
    });
</script>
