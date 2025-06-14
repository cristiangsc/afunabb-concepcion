<?php
namespace App\Traits;

use App\Models\Banco;
use App\Models\Cargo;
use App\Models\Comuna;
use App\Models\Cuenta;
use App\Models\Reparticion;
use App\Models\Sede;

trait GenericTrait
{
    public function mantenedores(): array
    {
        return [
        'comunas' => Comuna::select('id','name')->orderBy('name', 'ASC')->get(),
        'sedes' => Sede::select('id','name')->orderBy('name', 'ASC')->get(),
        'reparticiones' => Reparticion::select('id','name')->orderBy('name', 'ASC')->get(),
        'cargos' => Cargo::select('id','name')->orderBy('name', 'ASC')->get(),
        'cuentas' => Cuenta::select('id','name')->orderBy('name', 'ASC')->get(),
        'bancos' => Banco::select('id','name')->orderBy('name', 'ASC')->get()
    ];

    }
}
