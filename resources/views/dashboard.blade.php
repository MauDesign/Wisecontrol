<x-app-layout>
    <div class="p-6 text-gray-900 dark:text-gray-100">
        {{ __("Bienvenido!") }}
        <div class="row g-6">
            <div class="col-sm-6 col-lg-3 ">
                <div class="card card-border-shadow-primary h-100">
                    <div class="card-header">
                        <h3 class="card-title">Proyectos</h3>
                    </div>
                    <div class="card-body">
                        <h3>{{ $totalProyectos }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 ">
                <div class="card card-border-shadow-primary h-100">
                    <div class="card-header">
                        <h3 class="card-title">Gastos del mes</h3>
                    </div>
                    <div class="card-body">
                        <h3>$ {{ $sumaPagosMesActual }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="row g-6">
            <div class="col-sm-6 col-lg-4">
                <div class="card card-border-shadow-primary h-100">
                            <div class="card-header">
                            <h3>Proyectos por Responsables</h3>
                            </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Responsable</th>
                                        <th>Proyectos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($proyectoPorSupervisor as $responsable)
                                        <tr>
                                            <td>{{ $responsable->Responsable }}</td>
                                            <td>{{ $responsable->total }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</x-app-layout>
