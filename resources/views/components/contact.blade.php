<section id="contact">
    <div class="container justify-items-center items-center grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-4 py-4">

      <h2 class="font-semibold text-3xl sm:text-4xl md:text-5xl text-center">{{__("Lets talk about everything!")}}</h2>

        <div class="mx-auto w-full max-w-[700px]">
            <form action="https://formbold.com/s/FORM_ID" method="POST">
                <div class="mb-5">
                    <label
                        for="name"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Nombre Completo
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Nombre completo"
                        required
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>
                <div class="mb-5">
                    <label
                        for="email"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Correo Electrónico
                    </label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="email@domino.com"
                        required
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>
                <div class="mb-5">
                    <label
                        for="subject"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Asunto
                    </label>
                    <input
                        type="text"
                        name="subject"
                        id="subject"
                        placeholder="Tu asunto"
                        required
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>
                <div class="mb-5">
                    <label
                        for="message"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Mensaje
                    </label>
                    <textarea
                        rows="4"
                        name="message"
                        id="message"
                        placeholder="Escribre tu mensaje"
                        required
                        class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    ></textarea>
                </div>
                <div>
                    <button
                        class="inline-block px-8 py-2.5 bg-purple-600  text-white font-medium  leading-tight rounded-full shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out"
                    >
                        Enviar
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

