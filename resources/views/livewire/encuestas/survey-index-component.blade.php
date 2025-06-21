<div>
    <div class="max-w-4xl mx-auto my-8">
        <h2 class="text-2xl font-bold mb-6">Encuestas Disponibles</h2>

        @if($surveys->isEmpty())
            <div class="text-gray-500 text-center">
                No hay encuestas activas en este momento.
            </div>
        @else
            <div class="space-y-4">
                @foreach ($surveys as $survey)
                    <div class="p-4 border rounded shadow-sm bg-white hover:shadow-md transition">
                        <h3 class="text-lg font-semibold text-blue-700">{{ $survey->title }}</h3>
                        <p class="text-sm text-gray-600 mb-2">
                            Disponible desde {{ \Carbon\Carbon::parse($survey->start_at)->format('d/m/Y') }}
                            hasta {{ \Carbon\Carbon::parse($survey->end_at)->format('d/m/Y') }}
                        </p>
                        <p class="text-gray-800 mb-2">{{ $survey->description }}</p>

                        @auth
                            <a href="{{ route('encuestas.surveys.show', $survey->id) }}"
                               class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Responder encuesta
                            </a>
                        @else
                            <p class="text-red-600 text-sm">Debes iniciar sesión para responder.</p>
                        @endauth
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
