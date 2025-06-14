<?php

use Freshwork\ChileanBundle\Rut;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

function canView(string $permission): bool
{

    $permissions = auth()->user()->getAllPermissions();

    $permissions = $permissions->filter(function ($p) use ($permission) {
        return Str::contains($p->name, $permission);
    });

    return boolval($permissions->count());
}

function can(string $permission)
{
    if (!auth()->user()->can($permission)) {
        abort(403, 'Usted no tiene autorización');
    }
}

function getEnumValues($table, $field): array
{
    $test = DB::select("show columns from {$table} where field = '{$field}'");
    preg_match('/^enum\((.*)\)$/', $test[0]->Type, $matches);
    foreach (explode(',', $matches[1]) as $value) {
        $enum[] = trim($value, "'");
    }
    return $enum;
}

function getExtension($file, $tolower = true): string
{
    $file = basename($file);
    $pos = strrpos($file, '.');

    if ($file == '' || $pos === false) {
        return '';
    }

    $extension = substr($file, $pos + 1);
    if ($tolower) {
        $extension = strtolower($extension);
    }

    return $extension;
}

function dias($dia): string
{
    $dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
    return  $dias[$dia];
}

function meses($mes): string
{
    $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    return $meses[$mes];
}

function formatoFecha($fecha): string
{
  return  date_format(now()->parse($fecha),"Y-m-d");
}

function formatoFechaNormal($fecha): string
{
    return  date_format(now()->parse($fecha),"d-m-Y");
}
function rutFormat($rut):string
{
    return Rut::parse($rut)->format();
}

function num($numero): int
{
    return (intval(str_replace('.','',$numero)) );
}


function numMiles ($numero): string
{
  return  number_format($numero,0,',','.');
}

function sum ($values): float|int
{
    return array_sum($values);
}
