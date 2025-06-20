<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}">
                        <x-application-mark class="block h-9 w-auto"/>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                    <x-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                        {{ __('Inicio') }}
                    </x-nav-link>

                    <x-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')">
                        {{ __('About') }}
                    </x-nav-link>

                    @if (Route::has('login'))

                        @auth
                            <x-nav-link href="{{ url('/') }}">
                                Inicio
                            </x-nav-link>
                        @else
                            <x-nav-link href="{{ route('login') }}">
                                Iniciar Sesión
                            </x-nav-link>
                        @endauth

                    @endif

                </div>
            </div>
        </div>
        <!-- Hamburger -->
        <div class="-mr-2 flex items-center sm:hidden">
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


    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('welcome') }}"
                                   :active="request()->routeIs('welcome')">{{ __('Inicio') }}</x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('about') }}"
                                   :active="request()->routeIs('about')">{{ __('About') }}</x-responsive-nav-link>
        </div>
        @if (Route::has('login'))

            @auth
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link href="{{ url('/') }}">{{ __('dashboard') }}</x-responsive-nav-link>
                </div>
            @else
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link href="{{ route('login') }}"
                                           :active="request()->routeIs('login')">{{ __('Iniciar Sesión') }}</x-responsive-nav-link>
                </div>
            @endauth

        @endif
    </div>
</nav>
