<div>
    @foreach($survey->questions as $question)
        <h4>{{ $question->question }}</h4>
        <canvas id="chart-{{ $question->id }}"></canvas>

        <script>
            const ctx{{ $question->id }} = document.getElementById('chart-{{ $question->id }}');
            new Chart(ctx{{ $question->id }}, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($question->options->pluck('option_text')) !!},
                    datasets: [{
                        label: 'Votos',
                        data: {!! json_encode($question->options->map(fn($opt) => $opt->responses->count())) !!},
                        backgroundColor: ['#93c5fd', '#fca5a5', '#a7f3d0'],
                    }]
                }
            });
        </script>
    @endforeach

</div>
