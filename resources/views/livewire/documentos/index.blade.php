<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-10">
            <x-principal.header title="AFUNABB" subtitle="Documentos disponibles"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-2 sm:px-6 lg:px-4">
        <div class="xl:columns-2 lg:columns-2 md:columns-1 sm:columns-1 mx-4">
                <div class="relative mt-1 flex-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                  clip-rule="evenodd">
                            </path>
                        </svg>
                    </div>
                    <input type="text" id="table-search"
                           class="bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-800 block w-full pl-10 p-2.5"
                           placeholder="Buscar por título: " wire:model.live="search">
                </div>
        </div>
    </div>

    <div class="grid-container">
        <x-table-dinamic caption="LISTADO DE DOCUMENTOS">
            <thead class="text-xs text-gray-700 uppercase bg-indigo-100">
            <tr>
                <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0" wire:click="order('title')">
                    Título del documento
                    <x-sort sort="{{ $sort }}" direction="{{ $direction }}" campo='title'></x-sort>
                </th>
                <th scope="col" class="px-6 py-2 sticky top-0">
                    Tipo de archivo
                </th>
                <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0" wire:click="order('created_at')">
                    Fecha
                    <x-sort sort="{{ $sort }}" direction="{{ $direction }}" campo='created_at'></x-sort>
                </th>
                <th scope="col" class="py-2 text-right pr-4 cursor-pointer sticky top-0">
                    @can('documentos create')
                        <button
                            wire:click="OpenModalDocumentCreate()"
                            type="button"
                            class="inline-flex rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-neutral-50">
                            <svg class="h-7 w-7 text-green-800" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19,11H13V5a1,1,0,0,0-2,0v6H5a1,1,0,0,0,0,2h6v6a1,1,0,0,0,2,0V13h6a1,1,0,0,0,0-2Z"/>
                            </svg>
                        </button>
                    @endcan
                </th>
            </tr>
            </thead>
            <tbody class="text-xs font-light text-center">
            @foreach($documents as $document)
                <tr wire:key="{{ $document->id }}" class="border-b border-gray-300 hover:bg-gray-100">
                    <td class="py-4 px-4 text-left whitespace-nowrap border-dashed border-t border-gray-200">
                        <span class="text-gray-700">{{$document->title}}</span>
                    </td>
                    <td class="py-4 px-4 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        <span
                            class="text-gray-700 uppercase">{{ getExtension($document->media->first()->file_name,true) }}</span>
                    </td>
                    <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            <span
                                class="text-gray-700">{{$document->created_at}}</span>
                    </td>
                    <td class="text-center pr-2 whitespace-nowrap border-dashed border-t border-gray-200">
                        @can('documentos read')
                            <span wire:click="showDocument({{$document->id}})"
                                  class="bg-yellow-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Ver</span>
                        @endcan
                        @can('documentos delete')
                            <span wire:click="deleteDocument({{$document->id}})"
                                  wire:confirm="¿Desea eliminar este registro?"
                                  wire:stop
                                  class="bg-red-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Eliminar</span>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
            <x-slot:paginacion>
                @if ($documents->hasPages())
                    <div class="px-6 py-3 bg-gray-200">
                        {{ $documents->links() }}
                    </div>
                @endif
            </x-slot:paginacion>
        </x-table-dinamic>
    </div>

    <x-dialog-modal wire:model="showModal">

        <x-slot name="title">
            <div class="bg-green-800 text-white text-center border-b rounded-t-lg"> Subir Documento </div>
        </x-slot>

        <x-slot name="content">

            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">

                    <div class="col-span-6 sm:col-span-3 pb-3">
                        <x-component-input
                            placeholder="Título documento"
                            label="Nombre Documento"
                            name="title"
                        />
                    </div>

                    <div class="col-span-full mt-4">
                        <div wire:loading wire:target="file"
                             class="block text-md text-white bg-red-400 border border-red-400 h-12 items-center p-4 rounded-md relative mb-5"
                             role="alert">
                            <div
                                class="px-3 py-1 text-xs font-medium leading-none text-center text-green-800 bg-blue-200 rounded-full animate-pulse dark:bg-green-900">
                                loading...
                            </div>
                        </div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file">
                            Archivo PDF, DOCX, XLSX, PPTX
                        </label>
                        <input
                            class="block w-full text-sm py-1.5 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                            aria-describedby="user_avatar_help"
                            id="file" type="file" name="file" wire:model="file">
                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">
                            Máximo 4MB
                        </div>
                        <x-input-error for="file"/>
                    </div>
                </div>
            </div>


        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="store" wire:loading.attr="disabled" wire:target="store, file" type="button">
                {{__('Save all')}}
            </x-button>
            <x-button-cancel type="button" wire:click="$set('showModal',false)" class="ml-2">
                {{__('Close')}}
            </x-button-cancel>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="showModalDocument" :maxWidth="'6xl'">

        <x-slot name="title">
            <div class="bg-green-800 text-white text-center border-b rounded-t-lg"> DOCUMENTO</div>
        </x-slot>

        <x-slot name="content">

            <div class="space-y-6">
                <div class="border-b border-gray-900/10 pb-12">

                    <div class="col-span-full mt-4">

                        <div wire:loading wire:target="file"
                             class="block text-md text-white bg-red-400 border border-red-400 h-12 items-center p-4 rounded-md relative mb-5"
                             role="alert">
                            <strong class="mr-1">PDF cargando...</strong> ¡Espere un momento mientras se carga el
                            documento!
                        </div>

                        <div
                            class="flex justify-center rounded-lg border border-dashed border-gray-900/25 px-3 py-5 heightPdf">
                            @if($extension == 'pdf')
                                <iframe name="file" src="{{$urlDocument}}" class="w-full"></iframe>
                            @endif

                        </div>
                    </div>
                </div>
            </div>


        </x-slot>
        <x-slot name="footer">
            <x-button-cancel type="button" wire:click="$set('showModalDocument',false)" class="ml-2">
                {{__('Close')}}
            </x-button-cancel>
        </x-slot>
    </x-dialog-modal>
</div>
