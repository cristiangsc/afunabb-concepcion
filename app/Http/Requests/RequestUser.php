<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class RequestUser extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    public function rules($user = null): array
    {
        $roles = Role::pluck('name');
        $roles = $roles->join(',');

        return  [
            'rut'=>['required','min:8', Rule::unique('users','rut')->when($user, fn($query) => $query->ignore($user['id'])),'cl_rut'],
            'nombre'=>'required|min:3',
            'paterno'=>'required|min:3',
            'materno'=>'required|min:3',
            'telefono'=>'required',
            'fecha_nacimiento'=>'required',
            'fecha_ingreso_ubb'=>'required',
            'fecha_ingreso_afunabb'=>'required',
            'num_cuenta'=>'required',
            'direccion'=>'required|min:5',
            'calidad'=>'required',
            'sede_id'=>'required',
            'reparticion_id'=>'required',
            'cargo_id'=>'required',
            'comuna_id'=>'required',
            'cuenta_id'=>'required',
            'banco_id'=>'required',
            'email'=>['required','email', Rule::unique('users','email')->when($user, fn($query) => $query->ignore($user['id']))],
            'password'=>'min:8',
            'role'=>"required",
            'role.*'=>"in:{$roles}"
        ];

    }
}
