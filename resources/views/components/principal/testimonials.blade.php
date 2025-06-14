<div class="bg-neutral-100">
    <div class="container  mx-auto md:px-6 bg-neutral-50 rounded-lg shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]">
        <!-- Section: Design Block -->
        @if(!empty($testimonials))
    
            <div class="mb-32">
                <h5 class="mb-10 text-center font-extrabold text-4xl text-indigo-800 md:mb-6">
                    TESTIMONIOS DE NUESTROS ASOCIADOS Y ASOCIADAS
                </h5>
    
                @forelse($testimonials as $testimony)
                    <div class="mb-12 flex flex-wrap md:mb-3">
                        <div class="w-full sm:w-2/12 shrink-0 grow-0">
    
                            @if($testimony->user->profile_photo_path)
                                <img src="{{ asset('/storage/'.$testimony->user->profile_photo_path) }}"
                                     class="mb-6 rounded-lg shadow-lg w-28 xl:w-28" alt="Avatar"/>
                            @else
                                <img src="{{asset('assets/images/avatar.png')}}"
                                    class="mb-6 rounded-lg shadow-lg w-28 xl:w-28" alt="Avatar"/>
                            @endif
    
                        </div>
    
                        <div class="w-full sm:w-10/12 shrink-0 grow-0 basis-auto md:pl-6 sm:pl-6">
                            <p class="mb-3 font-semibold uppercase">{{$testimony->user->fullName}}</p>
                            <p class="mb-3 font-light text-xs">Fecha publicación: {{$testimony->created_at}}</p>
                            <p>
                                {{$testimony->testimony}}
                            </p>
                        </div>
                    </div>
    
                @empty
    
                    <h2 class="text-center font-bold hover:!text-red-500 cursor-pointer">No hay testimonios por el momento...</h2>
    
                @endforelse
    
            </div>
        @endif
    
    </div>
</div>