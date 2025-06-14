<div class="flex flex-col text-orange-600 text-center bg-indigo-100 items-center justify-center shadow-2xl">
    <div class="font-bold text-5xl w-28">{{ date_format(now(),"d") }}</div>
    <div class="font-semibold w-28 text-2lg">{{ meses(date('n')-1) }}</div>
    <div class="w-28 text-2xl">{{ date_format(now(),"Y" ) }}</div>
</div>
