<section id="contact" class="bg-neutral-200 text-center lg:text-left">
    <div class="container my-24 mx-auto md:px-6">
        <div class="px-6 py-12 md:px-12">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                <div class="mt-12 lg:mt-0">
                    <h1 class="mb-12 text-5xl font-bold leading-tight tracking-tight">
                        Contáctanos <br/><span class="text-green-700">Hablemos de todo</span>
                    </h1>
                    <p class="text-neutral-600">
                        ¿Tienes alguna consulta?, sugerencias o felicitaciones,
                        no dudes en comunicarte con tu asociación de funcionarios.
                    </p>
                </div>
                <div class="mb-12 lg:mb-0">

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">¡Error!</strong>
                            <span class="block sm:inline">Por favor corrige los siguientes errores:</span>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">{{ session('success') }}</strong>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">{{ session('error') }}</strong>
                        </div>
                    @endif

                    <div class="block rounded-lg bg-white px-6 py-12 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] md:px-12">

                        <form action="{{route('contact')}}" method="POST" class="space-y-8" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                                    Tu nombre
                                </label>
                                <div class="relative">

                                    <input type="text" id="name" name="name"
                                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full  p-2.5"
                                           placeholder="Escribe tu nombre" required>
                                </div>
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">
                                    Tu email
                                </label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                            <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                                            <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                                        </svg>
                                    </div>

                                    <input type="email" id="email" name="email"
                                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full ps-10 p-2.5"
                                           placeholder="name@ubiobio.cl" required>
                                </div>
                            </div>
                            <div>
                                <label for="subject"
                                       class="block mb-2 text-sm font-medium text-gray-900">Asunto</label>
                                <input type="text" id="subject" name="subject"
                                       class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500"
                                       placeholder="Permítenos saber en qué te podemos ayudar" required>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="message"
                                       class="block mb-2 text-sm font-medium text-gray-900">Tu mensaje</label>
                                <textarea id="message" name="message" rows="6"
                                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                                          placeholder="Deja un mensaje..."></textarea>
                            </div>
                            <x-button type="submit">
                                Enviar mensaje
                            </x-button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
