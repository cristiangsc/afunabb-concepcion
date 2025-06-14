<div>
<x-slot name="header">
    <div class="flex justify-between items-center gap-x-10">
        <x-principal.header title="AFUNABB" subtitle="Lo que debes saber"/>
        <x-fecha-hoy/>
    </div>
</x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="grid xl:grid-cols-12 lg:grid-cols-12 gap-4 sm:grid-cols-1">
            <div class="xl:col-span-8 lg:col-span-8 sm:col-span-12 overflow-hidden shadow-lg">
                @if($noticia->getFirstMediaUrl('noticias'))
                    <img class="w-full h-96 object-cover"
                         src="{{$noticia->getFirstMediaUrl('noticias')}}"
                         alt="{{$noticia->title}}">
                @endif

                <div class="px-6 py-4 flex flex-wrap mt-auto">
                    <div class="font-bold text-xl mb-2 uppercase">{{$noticia->title}}</div>
                </div>

                    <div class="px-6 py-4 flex flex-wrap mt-auto">
                        <p class="text-gray-700 text-base text-justify">
                            {!! $noticia->body !!}
                        </p>
                    </div>


                <div class="px-6 pt-4 flex flex-wrap mt-auto">

                    <div class="text-sm text-left">
                        <hr class="mb-2">
                        <p class="text-gray-900 leading-none text-xs">Escrito por: <span class="text-gray-900 leading-none uppercase text-xs">{{$noticia->user->fullName}}</span> </p>


                        <span
                            class="inline-block text-xs leading-none text-gray-700">Fecha: {{$noticia->created_at}}</span>
                    </div>
                </div>

            </div>

            <div class="xl:col-span-4 lg:col-span-4 sm:col-span-12">
               <x-list-noticia :noticias="$noticias"></x-list-noticia>
            </div>
    </div>

    </div>

</div>

