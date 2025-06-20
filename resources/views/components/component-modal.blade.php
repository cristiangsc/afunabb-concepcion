<div>
    <x-modal wire:model="showModal">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal header -->
            <div class="flex items-center p-4 border-b rounded-t">

                <div
                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="ms-2">
                    <h3 class="text-xl font-semibold text-gray-900">
                        {{$title}}
                    </h3>
                </div>
                <button type="button" wire:click="closeModal()"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>

            </div>

            <!-- Modal body -->
            <div class="p-6 space-y-6">
                {{ $slot }}
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                @if($action)
                    @if($action !== 'Show')
                        <x-button type="submit">
                            {{__($action)}}
                        </x-button>
                    @endif
                @endif
                <x-button-cancel type="button" wire:click="closeModal()">
                    {{__("Close")}}
                </x-button-cancel>
            </div>
        </div>
    </x-modal>
</div>
