<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CafeteriaEgreso;
use App\Models\CafeteriaIngreso;
use Illuminate\Support\Facades\DB;


class ChartsController extends Controller
{

    public static function ingresosCafeteria($anual): array
    {
        return DB::select('call sp_ingresos_detalle_cafeteria (?)',[$anual]);
    }

    public static function egresosCafeteria($anual): array
    {
        return DB::select('call sp_egresos_detalle_cafeteria (?)',[$anual]);
    }

    public static function egresosCafeteriaMensual($anual): array
    {
        return DB::select('call sp_egresos_cafeteria (?)',[$anual]);
    }

    public static function IngresoEgreso($anual): array
    {
        return DB::select('call sp_ingresos_egresos (?)',[$anual]);
    }

    public static function IngresosMensuales($anual): array
    {
        return DB::select('call sp_ingresos_cafeteria (?)',[$anual]);
    }

    public static function Utilidades($anual): array
    {
        return DB::select('call sp_grafico_utilidades (?)',[$anual]);
    }

}
