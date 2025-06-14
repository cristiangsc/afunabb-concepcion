<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AFUNABB') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->
    @livewireStyles
    @stack('css')
</head>
<body class="antialiased">
@include('sweetalert::alert')
<div class="min-h-screen bg-gray-100">

    @auth
        @livewire('navigation-menu')
    @else
        <x-navigation-menu-welcome/>
    @endauth

    <header class="bg-white shadow pt-2">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-start gap-x-10">
                <x-principal.header title="AFUNABB" subtitle="Asociación de Funcionari@s"/>
                <x-fecha-hoy/>
            </div>
        </div>
    </header>

    <x-carousel :carousel="$slides->take(5)" collection="slides" titulo="title"/>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="grid xl:grid-cols-12 lg:grid-cols-12 sm:grid-cols-1 md:grid-cols-4">
            <div class="xl:col-start-1 xl:col-span-12 lg:col-start-1 lg:col-span-12 md:col-start-1 md:col-span-4">
                <x-principal.news/>
                <x-principal.gallery/>
            </div>
        </div>
    </div>

    <x-principal.photo-directorio/>

    <x-principal.testimonials/>

    <x-principal.contacto/>

    <div id="button-up">
        <i class="fa fa-chevron-up"></i>
    </div>


    <x-footer/>

    @livewireScripts
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>
</body>
</html>














