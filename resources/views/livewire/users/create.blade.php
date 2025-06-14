<form wire:submit.prevent="{{$method}}">
    <x-dialog-modal wire:model="showModal" :maxWidth="'4xl'">

        <x-slot name="title">
            <div class="bg-indigo-800 text-white text-center border-b rounded-t-lg">
                {{$title}}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <x-component-input
                        placeholder="Ingrese el rut"
                        label="Rut"
                        name="rut"
                    />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-component-input
                        placeholder="Ingrese el nombre"
                        label="Nombre"
                        name="nombre"
                    />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-component-input
                        placeholder="Ingrese el apellido"
                        label="Apellido Paterno"
                        name="paterno"
                    />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-component-input
                        placeholder="Ingrese el apellido"
                        label="Apellido Materno"
                        name="materno"
                    />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Roles

                        <select wire:model="role"
                                multiple="multiple"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full">
                            <option value="">Seleccione</option>
                            @foreach($roles as $key => $rol)
                                <option value="{{ $key }}">{{ $rol }}</option>
                            @endforeach
                        </select>
                    </label>
                    <x-input-error for="role"/>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-component-input
                        placeholder="fecha nacimiento"
                        label="Fecha Nacimiento"
                        name="fecha_nacimiento"
                        type="date"
                    />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-component-input
                        placeholder="dirección"
                        label="Dirección"
                        name="direccion"
                    />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-component-input
                        placeholder="Ingrese teléfono"
                        label="Teléfono"
                        name="telefono"
                    />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-component-input-select
                        label="Comuna"
                        name="comuna_id"
                        campo="name"
                        :options="$colecciones['comunas']"
                    />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-component-input
                        placeholder="fecha ingreso UBB"
                        label="Fecha Ingreso UBB"
                        name="fecha_ingreso_ubb"
                        id="fecha_ingreso_ubb"
                        type="date"
                    />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-component-input
                        placeholder="fecha ingreso AFUNABB"
                        label="Fecha Ingreso AFUNABB"
                        name="fecha_ingreso_afunabb"
                        type="date"
                    />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="calidad"
                           class="block mb-2 text-sm font-medium text-gray-900">Calidad</label>
                    <label>
                        <select wire:model="calidad"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
                            <option value="">Seleccione</option>
                            @foreach($enums as $key => $enum)
                                @if($calidad == $enum)
                                    <option value="{{ $key+1 }}" selected>{{ $enum }}</option>
                                @else
                                    <option value="{{ $key+1 }}">{{ $enum }}</option>
                                @endif
                            @endforeach
                        </select>
                    </label>
                    <x-input-error for="calidad"/>

                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-component-input-select
                        label="Sede"
                        name="sede_id"
                        campo="name"
                        :options="$colecciones['sedes']"
                    />

                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-component-input-select
                        label="Repartición"
                        name="reparticion_id"
                        campo="name"
                        :options="$colecciones['reparticiones']"
                    />

                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-component-input-select
                        label="Cargo"
                        name="cargo_id"
                        campo="name"
                        :options="$colecciones['cargos']"
                    />

                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-component-input-select
                        label="Cuenta Bancaria"
                        name="cuenta_id"
                        campo="name"
                        :options="$colecciones['cuentas']"
                    />

                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-component-input-select
                        label="Bancos"
                        name="banco_id"
                        campo="name"
                        :options="$colecciones['bancos']"
                    />

                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-component-input
                        placeholder="Ingrese cuenta"
                        label="Número de cuenta"
                        name="num_cuenta"
                    />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-component-input
                        placeholder="Email"
                        label="Email"
                        name="email"
                        type="email"
                    />
                </div>
                @if($this->method == "userUpdate")
                    <div class="col-span-6 sm:col-span-3">
                        <x-component-input
                            placeholder="password"
                            label="Password"
                            name="password"
                            type="password"
                        />
                    </div>

                @endif
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button type="submit" class="ml-2">
                {{__($action)}}
            </x-button>
            <x-button-cancel type="button" wire:click="$set('showModal',false)" class="ml-2">
                {{__('Close')}}
            </x-button-cancel>
        </x-slot>


    </x-dialog-modal>
</form>



