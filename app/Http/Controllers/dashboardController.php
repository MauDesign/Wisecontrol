<?php

namespace App\Http\Controllers;

use  App\Models\Proyecto;
use  App\Models\Pagos;
use  Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProyectos = Proyecto::count();

        $sumaPagosMesActual = Pagos::whereMonth('fecha', Carbon::now()->month)
            ->whereYear('fecha', Carbon::now()->year)
            ->sum('monto');


            $proyectoPorSupervisor = Proyecto::select('Responsable',  DB::raw('count(*) as total'))
            ->groupBy('Responsable')
            ->get();    

        return view('dashboard', [
            'totalProyectos' => $totalProyectos,
            'sumaPagosMesActual' => $sumaPagosMesActual,
            'proyectoPorSupervisor' => $proyectoPorSupervisor,
        ]);

        
        
    }
}
