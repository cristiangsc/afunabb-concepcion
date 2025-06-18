<div class="pt-6">

    @if(!empty($galleries))
        <div class="bg-green-800  flex items-center justify-center py-2">
            <a href="{{ route('galeria') }}"><h2
                    class="xl:text-2xl md:text-xl sm:text-lg font-extrabold leading-7 text-white px-2 py-2 hover:!text-gray-300">
                    IMÁGENES DESTACADAS</h2></a>
        </div>
        <div class="grid-container mt-4">
            @forelse($galleries as $gallery)
                <div wire:key="{{ $gallery->id }}" class="card-cs">
                    @if($gallery->getUrl())
                        <img class="card-cs-img" src="{{$gallery->getUrl()}}" alt="Galeria de imagenes">
                    @endif
                </div>
                @empty
                    <h2 class="text-center font-bold hover:!text-red-500 cursor-pointer">No hay imágenes disponibles por el momento...</h2>
                @endforelse

        </div>
    @endif

</div>
