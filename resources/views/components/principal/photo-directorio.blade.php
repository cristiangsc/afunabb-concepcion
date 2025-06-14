<div>
    @if($photo)
        <div class="bg-black mb-4 hover:brightness-90">
            <div class="relative overflow-hidden  xl:h-[584px] lg:h-[500px] md:h-[450px] sm:h-[400px] h-36">
                <img src="{{$photo->getFirstMediaUrl('directivas')}}" alt="fotografía del directorio"
                     class="w-full h-full  object-center brightness-75">
            </div>
        </div>
    @endif
     <div class="grid justify-center">
            <livewire:directorios.directorio-modal/>
        </div>
</div>

