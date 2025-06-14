<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model.live="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->nombre }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->

        <div class="col-span-6 sm:col-span-4">
            <x-label for="direccion" value="{{ __('Dirección') }}" />
            <x-input id="direccion" type="text" class="mt-1 block w-full" wire:model="state.direccion" required autocomplete="direccion" />
            <x-input-error for="direccion" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="direccion" value="{{ __('Dirección') }}" />
            <x-input id="direccion" type="text" class="mt-1 block w-full" wire:model="state.direccion" required autocomplete="direccion" />
            <x-input-error for="direccion" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="comuna_id" value="{{ __('Comuna') }}" />

            <label>
                <select wire:model="state.comuna_id"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
                    <option value="">Seleccione</option>
                    @foreach($comunas as $key => $comuna)
                            <option value="{{ $comuna->id }}">{{ $comuna->name }}</option>
                    @endforeach
                </select>
            </label>
            <x-input-error for="comuna_id"/>

        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="banco_id" value="{{ __('Banco') }}" />

            <label>
                <select wire:model="state.banco_id"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
                    <option value="">Seleccione</option>
                    @foreach($bancos as $key => $banco)
                        <option value="{{ $banco->id }}">{{ $banco->name }}</option>
                    @endforeach
                </select>
            </label>
            <x-input-error for="banco_id"/>

        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="cuenta_id" value="{{ __('Tipo de Cuenta Bancaria') }}" />

            <label>
                <select wire:model="state.cuenta_id"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
                    <option value="">Seleccione</option>
                    @foreach($cuentas as $key => $cuenta)
                        <option value="{{ $cuenta->id }}">{{ $cuenta->name }}</option>
                    @endforeach
                </select>
            </label>
            <x-input-error for="cuenta_id"/>

        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="num_cuenta" value="{{ __('Nº cuenta') }}" />
            <x-input id="num_cuenta" type="text" class="mt-1 block w-full" wire:model="state.num_cuenta" required autocomplete="num_cuenta" />
            <x-input-error for="num_cuenta" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="calidad" class="text-red-500" value="{{ __('*Calidad') }}" />
            <x-input id="calidad" type="text" class="mt-1 block w-full" wire:model="state.calidad" disabled />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="reparticion_id" class="text-red-500" value="{{ __('*Repartición') }}" />
            <x-input id="reparticion_id" type="text" class="mt-1 block w-full" value="{{$this->user->reparticion->name}}" disabled />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="cargo_id" class="text-red-500" value="{{ __('*Cargo') }}" />
            <x-input id="cargo_id" type="text" class="mt-1 block w-full" value="{{$this->user->cargo->name}}" disabled />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label  class="text-red-500 text-xs" value="{{ __('*Debe solicitar la actualización a la directiva AFUNABB') }}" />
        </div>

    </x-slot>

    <x-slot name="actions">

        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>

    </x-slot>
</x-form-section>
