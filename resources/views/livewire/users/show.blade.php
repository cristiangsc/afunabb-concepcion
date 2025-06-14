<div>
    <x-component-modal title={{$title}} showModal={{$showModal}} action={{$action}}>
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6">
              <span class="text-gray-700 px-3 py-3 flex items-center">
                  @if($profile_photo_path)
                      <img class="w-24 h-24" src="{{ asset('storage/'.$profile_photo_path) }}" alt="Avatar">
                  @endif
                </span>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-disabled
                    label="Rut"
                    name="rut"
                    id="rut"
                />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-disabled
                    label="Nombre"
                    name="nombre"
                    id="nombre"
                />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-disabled
                    label="Apellido Paterno"
                    name="paterno"
                    id="paterno"
                />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-disabled
                    label="Apellido Materno"
                    name="materno"
                    id="materno"
                />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-disabled
                    label="Fecha Nacimiento"
                    name="fecha_nacimiento"
                    id="fecha_nacimiento"
                    type="date"
                />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-disabled
                    label="Dirección"
                    name="direccion"
                    id="direccion"
                />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-disabled
                    label="Teléfono"
                    name="telefono"
                    id="telefono"
                />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-disabled
                    label="Comuna"
                    name="comuna"
                    id="comuna_id"
                />

            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-disabled
                    label="Fecha Ingreso UBB"
                    name="fecha_ingreso_ubb"
                    id="fecha_ingreso_ubb"
                    type="date"
                />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-disabled
                    label="Fecha Ingreso AFUNABB"
                    name="fecha_ingreso_afunabb"
                    id="fecha_ingreso_afunabb"
                    type="date"
                />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-disabled
                    label="Calidad"
                    name="calidad"
                    id="calidad"
                />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-disabled
                    label="Sede"
                    name="sede"
                    id="sede_id"
                />

            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-disabled
                    label="Repartición"
                    name="reparticion"
                    id="reparticion_id"
                />

            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-disabled
                    label="Cargo"
                    name="cargo"
                    id="cargo_id"
                />

            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-disabled
                    label="Cuenta Bancaria"
                    name="cuenta"
                    id="cuenta_id"
                />

            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-disabled
                    label="Bancos"
                    name="banco"
                    id="banco_id"
                />

            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-disabled
                    placeholder="Ingrese cuenta"
                    label="Número de cuenta"
                    name="num_cuenta"
                    id="num_cuenta"
                />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-disabled
                    placeholder="Email"
                    label="Email"
                    name="email"
                    id="email"
                    type="email"
                />
            </div>
        </div>
    </x-component-modal>

</div>
