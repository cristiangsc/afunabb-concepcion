<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Banco;
use App\Models\Cargo;
use App\Models\Comuna;
use App\Models\Cuenta;
use App\Models\Reparticion;
use App\Models\Sede;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $sede1 = Sede::factory()->create(['name'=>'CHILLÁN']);
        $sede2 = Sede::factory()->create(['name'=>'CONCEPCIÓN']);

        $reparticion1 = Reparticion::factory()->create(['name'=>'FINANCIAMIENTO ESTUDIANTIL']);
        $reparticion2 = Reparticion::factory()->create(['name'=>'RECTORÍA']);

        $cuenta1 = Cuenta::factory()->create(['name'=>'CORRIENTE']);
        $cuenta2 = Cuenta::factory()->create(['name'=>'VISTA']);
        $cuenta3 = Cuenta::factory()->create(['name'=>'RUT']);
        $cuenta4 = Cuenta::factory()->create(['name'=>'AHORRO']);

        $cargo1 = Cargo::factory()->create(['name'=>'COORDINADOR']);
        $cargo2 = Cargo::factory()->create(['name'=>'JEFE DEPARTAMENTO']);

        $comuna1 = Comuna::factory()->create(['name'=>'CHILLÁN', 'region'=>'ÑUBLE','cod_region'=>16]);
        $comuna2 = Comuna::factory()->create(['name'=>'CONCEPCIÓN','region'=>'BIO-BIO','cod_region'=>8]);

        $banco1 = Banco::factory()->create(['name'=>'ESTADO']);
        $banco2 = Banco::factory()->create(['name'=>'SANTANDER']);

        $administrador = User::factory()->create([
             'nombre' => 'Cristian',
            'sede_id' => 1,
            'reparticion_id'=> 1,
            'banco_id'=> 1,
            'cuenta_id' => 1,
            'cargo_id' => 1,
            'comuna_id' => 1,
            'email' => 'cristian@example.com',
         ]);

         $presidente = User::factory()->create([
            'nombre' => 'Carla',
            'sede_id' => 1,
            'reparticion_id'=> 1,
            'banco_id'=> 1,
            'cuenta_id' => 1,
            'cargo_id' => 1,
            'comuna_id' => 1,
            'email' => 'carla@example.com',
        ]);

        $tesorero = User::factory()->create([
            'nombre' => 'Maria',
            'sede_id' => 2,
            'reparticion_id'=> 2,
            'banco_id'=> 2,
            'cuenta_id' => 2,
            'cargo_id' => 2,
            'comuna_id' => 2,
            'email' => 'maria@example.com',
        ]);

        $secretario = User::factory()->create([
            'nombre' => 'Eduardo',
            'sede_id' => 1,
            'reparticion_id'=> 2,
            'banco_id'=> 2,
            'cuenta_id' => 1,
            'cargo_id' => 2,
            'comuna_id' => 1,
            'email' => 'eduardo@example.com',
        ]);

        $director = User::factory()->create([
            'nombre' => 'felipe',
            'sede_id' => 2,
            'reparticion_id'=> 1,
            'banco_id'=> 1,
            'cuenta_id' => 1,
            'cargo_id' => 1,
            'comuna_id' => 2,
            'email' => 'felipe@example.com',
        ]);

        $director2 = User::factory()->create([
            'nombre' => 'Amparo',
            'sede_id' => 2,
            'reparticion_id'=> 1,
            'banco_id'=> 1,
            'cuenta_id' => 1,
            'cargo_id' => 1,
            'comuna_id' => 2,
            'email' => 'amparo@example.com',
        ]);

        $director3 = User::factory()->create([
            'nombre' => 'Paula',
            'sede_id' => 2,
            'reparticion_id'=> 1,
            'banco_id'=> 1,
            'cuenta_id' => 1,
            'cargo_id' => 1,
            'comuna_id' => 2,
            'email' => 'paula@example.com',
        ]);

        $director4 = User::factory()->create([
            'nombre' => 'Raul',
            'sede_id' => 2,
            'reparticion_id'=> 1,
            'banco_id'=> 1,
            'cuenta_id' => 1,
            'cargo_id' => 1,
            'comuna_id' => 2,
            'email' => 'raul@example.com',
        ]);

        $director5 = User::factory()->create([
            'nombre' => 'Susana',
            'sede_id' => 2,
            'reparticion_id'=> 1,
            'banco_id'=> 1,
            'cuenta_id' => 1,
            'cargo_id' => 1,
            'comuna_id' => 2,
            'email' => 'susana@example.com',
        ]);

        $director6 = User::factory()->create([
            'nombre' => 'Juan',
            'sede_id' => 2,
            'reparticion_id'=> 1,
            'banco_id'=> 1,
            'cuenta_id' => 1,
            'cargo_id' => 1,
            'comuna_id' => 2,
            'email' => 'juan@example.com',
        ]);


        $admin = Role::create(['name' => 'administrador']);
        $presi = Role::create(['name' => 'presidente']);
        $tesor = Role::create(['name' => 'tesorero']);
        $secre = Role::create(['name' => 'secretario']);
        $direc = Role::create(['name' => 'director']);
        $rol = Role::create(['name' => 'role']);


        $permissions = [
            'create',
            'read',
            'update',
            'delete'
        ];

        foreach (Role::all() as $rol) {
            foreach ($permissions as $p) {
                if ($rol->name == 'administrador') $rol->name = 'socio';
                Permission::create(['name' => "{$rol->name} $p"]);
            }
        }

        $admin->syncPermissions(Permission::all());
        $presi->syncPermissions(Permission::where('name','like',"%presidente%")->get());
        $tesor->syncPermissions(Permission::where('name','like',"%tesorero%")->get());
        $secre->syncPermissions(Permission::where('name','like',"%secretario%")->get());
        $direc->syncPermissions(Permission::where('name','like',"%director%")->get());
        $rol->syncPermissions(Permission::where('name','like',"%role%")->get());

        $socio = Role::create(['name' => 'socio']);
        $socio->syncPermissions(Permission::where('name','like',"%socio%")->get());

        $administrador->assignRole('administrador');
        $presidente->assignRole('presidente');
        $tesorero->assignRole('tesorero');
        $secretario->assignRole('secretario');
        $director->assignRole('director');

    }


}
