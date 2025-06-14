<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-8">
            <x-principal.header title="AFUNABB" subtitle="Gráfico de Ingresos"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>

    <div class="grid xl:grid-cols-8 lg:grid-cols-8 sm:grid-cols-1 md:grid-cols-4">
        <div class="xl:col-start-3 xl:col-span-4 lg:col-start-2 lg:col-span-6 md:col-start-1 md:col-span-4">

            <div class="col-span-3 sm:col-span-3 my-4">

                <label for="featuresOptions" id="features"
                       class="block mb-2 text-sm font-medium text-gray-900 uppercase">Año a graficar
                    <select id="featuresOptions" class="select mt-2 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-48 p-2.5">
                        @foreach($this->anios as $key => $a)
                            <option value="{{ $anios[$key] }}">{{$a}}</option>
                        @endforeach
                    </select>
                </label>
            </div>

            <div class="chart-container">

                <canvas id="myChartUtilidad" class="py-5"></canvas>

                <canvas id="myChartIngresos" class="py-5"></canvas>

                <canvas id="myChartEgresos" class="py-5"></canvas>

                <canvas id="myChartMensuales" class="py-5"></canvas>

                <canvas id="myChartIngresosMensuales" class="py-5"></canvas>

                <canvas id="myChartEgresosMensuales" class="py-5"></canvas>

            </div>

        </div>
    </div>

</div>

