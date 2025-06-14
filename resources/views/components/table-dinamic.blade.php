<div>
        <div class="container">
            <div class="relative overflow-x-auto shadow-md md:rounded-lg bg-indigo-800">

                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <caption class="text-white font-bold text-xl">{{ $caption }}</caption>
                    {{$slot}}
                </table>
                <div>
                    {{ $paginacion }}
                </div>
            </div>
        </div>
</div>
