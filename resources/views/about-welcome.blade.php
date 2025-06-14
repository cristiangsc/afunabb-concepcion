<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->
    @livewireStyles

</head>
<body class="antialiased">
<div class="min-h-screen bg-gray-100">

    <x-navigation-menu-welcome/>
    <header class="bg-white shadow pt-2">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-start gap-x-10">
                <x-principal.header title="AFUNABB" subtitle="Acerca de nuestra Asociación"/>
                <x-fecha-hoy/>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="grid xl:grid-cols-12 lg:grid-cols-12 sm:grid-cols-1 md:grid-cols-4">
            <div class="xl:col-start-1 xl:col-span-12 lg:col-start-1 lg:col-span-12 md:col-start-1 md:col-span-4">
                <form class="rounded overflow-hidden shadow-lg px-6 py-6 mt-4 bg-white">
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <div class="bg-indigo-800  flex items-center justify-center  py-2">
                                <h2 class="xl:text-xl md:text-lg sm:text-md font-semibold leading-7 text-white px-2 py-2">
                                    ACERCA DE NUESTRA ASOCIACIÓN DE FUNCIONARIOS/AS
                                </h2>
                            </div>
                            <div class="mt-6 grid grid-cols-1 justify-items-center">

                                @if(!empty($about))
                                    @if($about->getFirstMediaUrl('abouts'))
                                        <img class="w-full h-48 object-cover"
                                             src="{{$about->getFirstMediaUrl('abouts')}}"
                                             alt="historia">
                                    @endif

                                    <div class="px-6 py-4 flex flex-wrap mt-auto hover:text-gray-400">
                                        <div class="font-bold text-xl mb-2">HISTORIA DE AFUNABB CHILLÁN</div>
                                        <p class="text-gray-700 text-base text-justify not-italic font-normal">
                                            {!! $about->history !!}
                                        </p>
                                    </div>

                                    <div class="px-6 py-4 flex flex-wrap mt-auto hover:text-gray-400">
                                        <div class="font-bold text-xl mb-2">MISIÓN AFUNABB CHILLÁN</div>
                                        <p class="text-gray-700 text-base text-justify not-italic font-normal">
                                            {!! $about->mission !!}
                                        </p>
                                    </div>

                                    <div class="px-6 py-4 flex flex-wrap mt-auto hover:text-gray-400">
                                        <div class="font-bold text-xl mb-2">VISIÓN AFUNABB CHILLÁN</div>
                                        <p class="text-gray-700 text-base text-justify not-italic font-normal">
                                            {!! $about->vision !!}
                                        </p>
                                    </div>

                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-footer/>

    @livewireScripts
</div>
</body>
</html>
