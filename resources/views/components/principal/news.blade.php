<div>
    @if(!empty($noticias))
        <div class="bg-indigo-800  flex items-center justify-center  py-2">
            <a href="{{ route('noticias') }}"><h2
                    class="xl:text-2xl md:text-xl sm:text-lg font-extrabold leading-7 text-white px-2 py-2 hover:!text-gray-300">
                    NOTICIAS DE ACTUALIDAD AFUNABB CHILLÁN</h2></a>
        </div>
        <div
            class="mt-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2  md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 justify-items-center">
            @forelse($noticias as $noticia)
                <div wire:key="{{ $noticia->id }}"
                     class="col-span-1 flex flex-col overflow-hidden shadow-lg">

                    @if($noticia->getFirstMediaUrl('noticias'))
                        <img class="w-full h-48 object-cover"
                             src="{{$noticia->getFirstMediaUrl('noticias')}}"
                             alt="{{$noticia->title}}">
                    @endif

                    <a href="{{route('noticias.ver',$noticia->id)}}"
                       class="px-6 py-4 flex flex-wrap mt-auto hover:text-gray-400">
                        <div class="font-bold text-sm mb-2 uppercase">{{$noticia->title}}</div>
                        <p class="text-gray-700 text-sm  text-justify not-italic font-normal">
                            {{  Str::limit(strip_tags($noticia->body),150,'...') }}
                        </p>
                    </a>

                    <div class="px-6 pt-4 flex flex-wrap mt-auto mb-3">

                        <div class="text-sm text-left">
                            <hr class="mb-2">
                            <p class="text-gray-900 leading-none text-xs not-italic font-normal">
                                Escrito por: {{$noticia->user->fullName}}</p>
                            <span
                                class="inline-block text-xs leading-none text-gray-700 not-italic font-normal">Fecha: {{$noticia->created_at}}</span>
                        </div>
                    </div>
                </div>

                @empty

                    <h2 class="text-center font-bold hover:!text-red-500 cursor-pointer">No hay noticias publicadas por el momento...</h2>

                @endforelse

        </div>
    @endif
</div>
