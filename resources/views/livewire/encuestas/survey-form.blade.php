<div>
    <div class="max-w-4xl mx-auto p-4">
        <form wire:submit.prevent="submit" class="space-y-6">
            <div>
                <label>Título</label>
                <input type="text" wire:model="title" class="w-full border rounded p-2">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Descripción</label>
                <textarea wire:model="description" class="w-full border rounded p-2"></textarea>
            </div>

            <div class="flex gap-4">
                <div>
                    <label>Inicio</label>
                    <input type="datetime-local" wire:model="start_at" class="border rounded p-2">
                    @error('start_at') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label>Fin</label>
                    <input type="datetime-local" wire:model="end_at" class="border rounded p-2">
                    @error('end_at') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <hr>

            <div>
                <h3 class="font-bold text-lg mb-2">Preguntas</h3>

                @foreach($questions as $qIndex => $q)
                    <div class="border p-4 mb-4 rounded shadow-sm">
                        <div class="flex justify-between items-center">
                            <label>Pregunta #{{ $qIndex + 1 }}</label>
                            <button type="button" wire:click="removeQuestion({{ $qIndex }})" class="text-red-500">Eliminar</button>
                        </div>

                        <input type="text" wire:model="questions.{{ $qIndex }}.question" class="w-full border rounded p-2 my-2">
                        @error("questions.$qIndex.question") <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                        <div>
                            <label>Opciones</label>
                            @foreach($q['options'] as $oIndex => $opt)
                                <div class="flex items-center gap-2 mb-1">
                                    <input type="text" wire:model="questions.{{ $qIndex }}.options.{{ $oIndex }}.option_text" class="flex-1 border rounded p-1">
                                    <button type="button" wire:click="removeOption({{ $qIndex }}, {{ $oIndex }})" class="text-red-500">✕</button>
                                </div>
                            @endforeach
                            <button type="button" wire:click="addOption({{ $qIndex }})" class="text-blue-500 mt-2">+ Agregar opción</button>
                        </div>
                    </div>
                @endforeach

                <button type="button" wire:click="addQuestion" class="bg-green-600 text-white px-4 py-2 rounded">+ Agregar Pregunta</button>
            </div>

            <div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Crear Encuesta</button>
            </div>
        </form>
    </div>

</div>
