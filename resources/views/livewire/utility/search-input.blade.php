<div class="xl:visible lg:visible md:visible invisible">
    <label for="table-search" class="sr-only">Buscar</label>
    <div class="relative mt-1 flex-1 pr-3">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-500" fill="currentColor"
                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                      clip-rule="evenodd">
                </path>
            </svg>
        </div>
        <input type="text" id="table-search"
               class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-800 block w-full pl-10 p-2.5"
               placeholder="Buscar"  wire:model.live="search">
    </div>
</div>
