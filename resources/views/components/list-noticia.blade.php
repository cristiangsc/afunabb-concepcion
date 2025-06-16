<div>

    <div class="grid grid-cols-3 gap-4 overflow-hidden shadow-lg bg-white py-2">
        <div class="font-bold text-2xl col-span-3 justify-self-center text-red-600">NOTICIAS RECIENTES
            <hr>
        </div>

        @foreach($noticias as $noticia)
                <div class="col-span-1 justify-self-end">
                    @if($noticia->getFirstMediaUrl('noticias'))
                        <img class="w-24 h-24 object-scale-down rounded border bg-white p-1"
                             src="{{$noticia->getFirstMediaUrl('noticias')}}"
                             alt="{{$noticia->title}}">
                    @endif
                </div>
                <a href="{{route('noticias.ver',$noticia->id)}}" class="col-span-2 text-left">
                    <div class="font-semibold text-xs uppercase  mb-2 mr-2">{{$noticia->title}}</div>
                    <div class="text-xs  mb-2">Publicado el {{date_format(now()->parse($noticia->created_at),"d-m-Y")}}</div>
                </a>

                @endforeach
            </div>

</div>
