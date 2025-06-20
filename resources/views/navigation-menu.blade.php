<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto sm:px-4 lg:px-6">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark/>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-3 md:-my-px sm:ml-5 lg:flex">

                    <x-nav-link href="{{ route('aboutme') }}" :active="request()->routeIs('aboutme')">
                        {{ __('About') }}
                    </x-nav-link>

                    @if(canView('noticia'))
                        <x-nav-link href="{{ route('noticias') }}" :active="request()->routeIs('noticias')">
                            {{ __('News') }}
                        </x-nav-link>
                    @endif

                    @if(canView('beneficios'))
                        <x-nav-link href="{{ route('beneficios') }}" :active="request()->routeIs('beneficios')">
                            {{ __('Beneficios') }}
                        </x-nav-link>
                    @endif

                    @if(canView('galeria'))
                        <x-nav-link href="{{ route('galeria') }}" :active="request()->routeIs('galeria')">
                            {{ __('Gallery') }}
                        </x-nav-link>
                    @endif

                    <div class="mt-4 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                       {{ __('Finanzas') }}
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">

                                @if(canView('finanza'))
                                    <div
                                        class="block px-4 py-2 text-xs text-gray-400">{{ __('Antecedentes Económicos') }}</div>
                                    <x-dropdown-link href="{{ route('contabilidad') }}">
                                        {{ __('Informes Contables') }}
                                    </x-dropdown-link>
                                @endif

                            </x-slot>

                        </x-dropdown>
                    </div>

                    <div class="mt-4 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                            class="inline-flex items-center px-2 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                       {{ __('Descargas') }}
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div
                                    class="block px-4 py-2 text-xs text-gray-400">{{ __('Archivos descargables') }}</div>

                                @if(canView('actas'))
                                    <x-dropdown-link href="{{ route('actas') }}">
                                        {{ __('Actas') }}
                                    </x-dropdown-link>
                                @endif

                                @if(canView('documentos'))
                                    <x-dropdown-link href="{{ route('documentos') }}">
                                        {{ __('Documentos') }}
                                    </x-dropdown-link>
                                @endif

                            </x-slot>

                        </x-dropdown>
                    </div>

                    @if(canView('socio'))

                        <div class="mt-4 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                            class="inline-flex items-center px-2 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                       {{ __('Configuraciones') }}
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                        </svg>
                                    </button>
                                </span>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-gray-400">{{ __('Mantenedores') }}</div>

                                    @if(canView('bancos'))
                                        <x-dropdown-link href="{{ route('bancos') }}">
                                            {{ __('Bancos') }}
                                        </x-dropdown-link>
                                    @endif

                                    @if(canView('cargos'))
                                        <x-dropdown-link href="{{ route('cargos') }}">
                                            {{ __('Cargos') }}
                                        </x-dropdown-link>
                                    @endif

                                    @if(canView('comunas'))
                                        <x-dropdown-link href="{{ route('comunas') }}">
                                            {{ __('Comunas') }}
                                        </x-dropdown-link>
                                    @endif

                                    @if(canView('cuentas'))
                                        <x-dropdown-link href="{{ route('cuentas') }}">
                                            {{ __('Cuentas') }}
                                        </x-dropdown-link>
                                    @endif

                                    @if(canView('reparticion'))
                                        <x-dropdown-link href="{{ route('reparticiones') }}">
                                            {{ __('Reparticiones') }}
                                        </x-dropdown-link>
                                    @endif

                                    @if(canView('sedes'))
                                        <x-dropdown-link href="{{ route('sedes') }}">
                                            {{ __('Sede') }}
                                        </x-dropdown-link>
                                    @endif

                                    <div
                                        class="block px-4 py-2 text-xs text-gray-400">{{ __('Otras Configuraciones') }}</div>

                                    @if(canView('photos-directiva'))
                                        <x-dropdown-link href="{{ route('photos') }}">
                                            {{ __('Fotografía Directorio') }}
                                        </x-dropdown-link>
                                    @endif

                                    @if(canView('slides'))
                                        <x-dropdown-link href="{{ route('slides') }}">
                                            {{ __('Slide Principal') }}
                                        </x-dropdown-link>
                                    @endif

                                    @if(canView('saludos'))
                                        <x-dropdown-link href="{{ route('saludos') }}">
                                            {{ __('Saludo de Cumpleaños') }}
                                        </x-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-200"></div>
                                    <div
                                        class="block px-4 py-2 text-xs text-gray-400">{{ __('Administrar Roles y Permisos') }}</div>
                                    @if(canView('role'))
                                        <x-dropdown-link href="{{ route('roles') }}">
                                            {{ __('Roles and Permissions') }}
                                        </x-dropdown-link>
                                    @endif
                                </x-slot>

                            </x-dropdown>
                        </div>

                        <div class="mt-4 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                            class="inline-flex items-center px-2 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                       {{ __('Administración') }}
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                        </svg>
                                    </button>
                                </span>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-gray-400">{{ __('Mantenedores') }}</div>

                                    @if(canView('usuarios'))
                                        <x-dropdown-link href="{{ route('users') }}">
                                            {{ __('Socios/as') }}
                                        </x-dropdown-link>
                                    @endif

                                    @if(canView('constancias'))
                                        <x-dropdown-link href="{{ route('constancias') }}">
                                            {{ __('Constancias') }}
                                        </x-dropdown-link>
                                    @endif

                                    @if(canView('beneficiosOtorgados'))
                                        <x-dropdown-link href="{{ route('beneficios.otorgados') }}">
                                            {{ __('Otorgar Beneficios') }}
                                        </x-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-200"></div>

                                    @if(canView('directiva'))
                                        <div class="block px-4 py-2 text-xs text-gray-400">{{ __('Directiva') }}</div>

                                        <x-dropdown-link href="{{ route('directorios') }}">
                                            {{ __('Mantenedor Directiva') }}
                                        </x-dropdown-link>
                                    @endif

                                </x-slot>

                            </x-dropdown>
                        </div>

                    @endif

                    <!-- Settings Dropdown -->
                    <div class="mt-3 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                    <span class="inline-flex rounded-md w-52">
                                    <button type="button"
                                            class="inline-flex items-center px-2 py-2 uppercase border border-transparent text-sm leading-3 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->nombre }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">{{ __('Manage Account') }}</div>

                                @if(canView('perfil'))
                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                @endif

                                @if(canView('misBeneficios'))
                                    <div class="border-t border-gray-200"></div>
                                    <x-dropdown-link href="{{ route('user.beneficios') }}">
                                        {{ __('Mis Beneficios') }}
                                    </x-dropdown-link>
                                @endif

                                @if(canView('misConstancias'))
                                    <x-dropdown-link href="{{ route('user.constancias') }}">
                                        {{ __('Mis Constancias') }}
                                    </x-dropdown-link>
                                @endif

                                @if(canView('testimonios'))
                                    <x-dropdown-link href="{{ route('testimony') }}">
                                        {{ __('Testimonios') }}
                                    </x-dropdown-link>
                                @endif

                                <div class="border-t border-gray-200"></div>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <x-dropdown-link href="{{ route('logout') }}"
                                                     @click.prevent="$root.submit();">{{ __('Log Out') }}</x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hamburger -->
        <div class="-mr-2 flex items-center lg:hidden">
            <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>


    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}"
                                   :active="request()->routeIs('dashboard')">{{ __('Inicio') }}</x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('aboutme') }}"
                                   :active="request()->routeIs('aboutme')">{{ __('About') }}</x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('noticias') }}"
                                   :active="request()->routeIs('noticias')">{{ __('News') }}</x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('beneficios') }}"
                                   :active="request()->routeIs('beneficios')">{{ __('Beneficios') }}</x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('galeria') }}"
                                   :active="request()->routeIs('galeria')">{{ __('Gallery') }}</x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="font-medium text-base text-gray-800">Finanzas</div>
            </div>
            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                @if(canView('aporte'))
                    <x-responsive-nav-link href="{{ route('contabilidad') }}"
                                           :active="request()->routeIs('contabilidad')">
                        {{ __('Informes Contables') }}
                    </x-responsive-nav-link>
                @endif
            </div>

            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="font-medium text-base text-gray-800">Archivos descargables</div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-responsive-nav-link href="{{ route('actas') }}" :active="request()->routeIs('actas')">
                        {{ __('Actas') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link href="{{ route('documentos') }}" :active="request()->routeIs('documentos')">
                        {{ __('Documentos') }}
                    </x-responsive-nav-link>
                </div>
            </div>

            @if(canView('socio'))
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        <div class="font-medium text-base text-gray-800">Configuraciones</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <!-- Account Management -->
                        @if(canView('bancos'))
                            <x-responsive-nav-link href="{{ route('bancos') }}" :active="request()->routeIs('bancos')">
                                {{ __('Bancos') }}
                            </x-responsive-nav-link>
                        @endif

                        @if(canView('cargos'))
                            <x-responsive-nav-link href="{{ route('cargos') }}" :active="request()->routeIs('cargos')">
                                {{ __('Cargos') }}
                            </x-responsive-nav-link>
                        @endif

                        @if(canView('comunas'))
                            <x-responsive-nav-link href="{{ route('comunas') }}"
                                                   :active="request()->routeIs('comunas')">
                                {{ __('Comunas') }}
                            </x-responsive-nav-link>
                        @endif

                        @if(canView('cuentas'))
                            <x-responsive-nav-link href="{{ route('cuentas') }}"
                                                   :active="request()->routeIs('cuentas')">
                                {{ __('Cuentas') }}
                            </x-responsive-nav-link>
                        @endif

                        @if(canView('reparticion'))
                            <x-responsive-nav-link href="{{ route('reparticiones') }}"
                                                   :active="request()->routeIs('reparticiones')">
                                {{ __('Reparticiones') }}
                            </x-responsive-nav-link>
                        @endif

                        @if(canView('photos'))
                            <x-responsive-nav-link href="{{ route('photos') }}" :active="request()->routeIs('photos')">
                                {{ __('Fotografía Directorio') }}
                            </x-responsive-nav-link>
                        @endif

                        @if(canView('slides'))
                            <x-responsive-nav-link href="{{ route('slides') }}" :active="request()->routeIs('slides')">
                                {{ __('Slide Principal') }}
                            </x-responsive-nav-link>
                        @endif

                        @if(canView('saludos'))
                            <x-responsive-nav-link href="{{ route('saludos') }}"
                                                   :active="request()->routeIs('saludos')">
                                {{ __('Saludo de Cumpleaños') }}
                            </x-responsive-nav-link>
                        @endif

                        @if(canView('role'))
                            <x-responsive-nav-link href="{{ route('roles') }}" :active="request()->routeIs('roles')">
                                {{ __('Roles and Permissions') }}
                            </x-responsive-nav-link>
                        @endif
                    </div>
                </div>

                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        <div class="font-medium text-base text-gray-800">Administración</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <!-- Account Management -->
                        @if(canView('usuarios'))
                            <x-responsive-nav-link href="{{ route('users') }}" :active="request()->routeIs('users')">
                                {{ __('Socios/as') }}
                            </x-responsive-nav-link>
                        @endif

                        @if(canView('constancias'))
                            <x-responsive-nav-link href="{{ route('constancias') }}"
                                                   :active="request()->routeIs('constancias')">
                                {{ __('Constancias') }}
                            </x-responsive-nav-link>
                        @endif

                        @if(canView('beneficiosOtorgados'))
                            <x-responsive-nav-link href="{{ route('beneficios.otorgados') }}"
                                                   :active="request()->routeIs('beneficios.otorgados')">
                                {{ __('Otorgar Beneficios') }}
                            </x-responsive-nav-link>
                        @endif

                        @if(canView('directiva'))
                            <x-responsive-nav-link href="{{ route('directorios') }}"
                                                   :active="request()->routeIs('directorios')">
                                {{ __('Mantenedor Directiva') }}
                            </x-responsive-nav-link>
                        @endif
                    </div>
                </div>
            @endif

            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 mr-3">
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                 alt="{{ Auth::user()->nombre }}"/>
                        </div>
                    @endif

                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->nombre }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    @if(canView('perfil'))
                        <x-responsive-nav-link href="{{ route('profile.show') }}"
                                               :active="request()->routeIs('profile.show')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>
                    @endif

                    @if(canView('misBeneficios'))
                        <x-responsive-nav-link href="{{ route('user.beneficios') }}"
                                               :active="request()->routeIs('user.beneficios')">
                            {{ __('Mis Beneficios') }}
                        </x-responsive-nav-link>
                    @endif

                    @if(canView('misConstancias'))
                        <x-responsive-nav-link href="{{ route('user.constancias') }}"
                                               :active="request()->routeIs('user.constancias')">
                            {{ __('Mis Constancias') }}
                        </x-responsive-nav-link>
                    @endif

                    @if(canView('testimonios'))
                        <x-responsive-nav-link href="{{ route('testimony') }}"
                                               :active="request()->routeIs('testimony')">
                            {{ __('Testimonios') }}
                        </x-responsive-nav-link>
                    @endif

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-responsive-nav-link href="{{ route('api-tokens.index') }}"
                                               :active="request()->routeIs('api-tokens.index')">
                            {{ __('API Tokens') }}
                        </x-responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-responsive-nav-link href="{{ route('logout') }}"
                                               @click.prevent="$root.submit();">{{ __('Log Out') }}</x-responsive-nav-link>
                    </form>
                </div>

            </div>

        </div>
    </div>
</nav>











