<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-start gap-x-10">
            <x-principal.header title="AFUNABB" subtitle="Asociación de Funcionari@s"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>

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


</x-app-layout>
