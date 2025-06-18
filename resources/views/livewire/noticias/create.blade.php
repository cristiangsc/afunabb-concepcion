<div>
    <x-dialog-modal wire:model="showModal" :maxWidth="'6xl'">

        <x-slot name="title">
            <div class="bg-green-800 text-white text-center border-b rounded-t-lg"> {{$titleForm}}
            </div>
        </x-slot>

        <x-slot name="content">

            <div class="space-y-6">
                <div class="border-b border-gray-900/10 pb-12">

                    <x-component-input
                        placeholder="Ingrese el Título de la noticia"
                        label="Título de la noticia"
                        name="title"
                    />

                    <div class="col-span-full mt-4" wire:ignore>
                        <textarea id="editor"
                             class="w-full"
                             wire:model="body"
                        >
                            {!! $body !!}
                        </textarea>
                    </div>

                    <div class="col-span-full">
                        <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Imagen</label>

                        <div wire:loading wire:target="image"
                             class="block text-md text-white bg-red-400 border border-red-400 h-12 items-center p-4 rounded-md relative mb-5"
                             role="alert">
                            <strong class="mr-1">Imagen cargando...</strong> ¡Espere un momento mientras se carga la
                            imagen!
                        </div>

                        <div
                            class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                @if($image)
                                    <img src="{{$image->temporaryUrl()}}" alt="fotografía" class="md:max-w-screen"/>
                                @endif

                                @if($imagenEdit)
                                    <img class="md:max-w-screen"
                                         src="{{$imagenEdit}}"
                                         alt="{{$title}}">
                                @endif

                                <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                                     aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <div class="mt-4 flex justify-center text-sm leading-6 text-gray-600">
                                    <label for="image"
                                           class="relative cursor-pointer rounded-md bg-white font-semibold text-green-800 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="image" name="image" wire:model="image" type="file" class="sr-only">
                                    </label>
                                </div>
                                <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 2MB</p>
                            </div>
                        </div>
                        <x-input-error for="image"/>
                    </div>


                </div>
            </div>


        </x-slot>
        <x-slot name="footer">
            <x-button type="button" wire:click="save()" class="ml-2">
                {{__($button)}}
            </x-button>
            <x-button-cancel type="button" wire:click="$set('showModal',false)" class="ml-2">
                {{__('Close')}}
            </x-button-cancel>
        </x-slot>

    </x-dialog-modal>



    @push('scripts')

        <script>

            let editor2;

            function aplicarAlturaEditor() {
                setTimeout(() => {
                    const editable = editor2?.ui?.getEditableElement?.();
                    if (editable) {
                        editable.style.minHeight = '500px';
                        editable.style.maxHeight = 'none';
                    }
                }, 100); // esperar a que esté visible
            }

                ClassicEditor
                    .create(document.querySelector('#editor'))
                    .then(function (editor) {
                         editor2 = editor
                        aplicarAlturaEditor();
                        editor.model.document.on('change:data', () => {
                        @this.set('body', editor.getData())
                        })
                    })
                    .catch(error => {
                        console.error(error);
                    });


                document.addEventListener('livewire:initialized', () => {
                    @this.on('nuevo_editor', (event) => {
                        aplicarAlturaEditor();
                        editor2.setData('')
                    });
                });

            document.addEventListener('livewire:initialized', () => {
                @this.on('editar_editor', (body) => {
                    editor2.setData(...body)
                });
            });

        </script>

    @endpush

</div>
