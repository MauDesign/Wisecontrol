<x-app-layout>
    <div class="container">
    <div class=" container card">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           Proyectos
        </h2>
        <p><strong>Cliente</strong>: {{$proyecto->Cliente }}</p>
        <p><strong>Responsable</strong>: {{$proyecto->Responsable }}</p>
        <p><strong>Fecha de inicio de obra</strong>: {{$proyecto->Fecha_obra }}</p>
    </div>
    <div class="container row g-6 mt-2">
        <div class="container card col-sm-4">
            <h3>Gastos del proyecto</h3>
            <h4>{{$totalPagosAprobados}}</h4>
        </div>
        <div class="container card col-sm-6">
            <h3>Requisiciones</h3>
            <table class="table datatable">
                <th>
                    <td>Id requisicion</td>
                    <td>Fecha de solicitud</td>
                    <td>Tipo</td>
                    <td>Estatus</td>
                </th>
                <tbody>
                @foreach($requisiciones as $requisicion)
                    <tr>
                        
                        <td>{{ $requisicion->id }}</td>
                        <td>{{ $requisicion->tipo }}</td>
                        <td>{{ $requisicion->fecha_solicitud }}</td>
                        <td>{{ $requisicion->estatus }}</td>
                    </tr>
                    @endforeach
            </table>
        </div>
    </div>
    <div class="row mt-2">
    <div class="container card col-sm-6">
            <h3>Pagos</h3>
            <table class="table datatable">
                <th>
                    <td>Id pago</td>
                    <td>Tipo pago</td>
                    <td>Forma de pago</td>
                    <td>Estatus</td>
                </th>
                <tbody>
                @foreach($pagosProyecto as $pagos)
                    <tr>
                        <td>{{ $pagos->id }}</td>
                        <td>{{ $pagos->tipo_pago }}</td>
                        <td>{{ $requisicion->fecha_solicitud }}</td>
                        <td>{{ $pagos->forma_pago }}</td>
                        <td>{{ $pagos->monto }}</td>
                    </tr>
                    @endforeach
            </table>
        </div>
    </div>
    </div>
</x-app-layout>