<div>
    <form wire:submit.prevent="submit">
        @foreach($survey->questions as $question)
            <div>
                <strong>{{ $question->question }}</strong>
                @foreach($question->options as $option)
                    <label>
                        <input type="radio" wire:model="responses.{{ $question->id }}" value="{{ $option->id }}">
                        {{ $option->option_text }}
                    </label>
                @endforeach
            </div>
        @endforeach

        <button type="submit">Enviar</button>
    </form>
</div>
