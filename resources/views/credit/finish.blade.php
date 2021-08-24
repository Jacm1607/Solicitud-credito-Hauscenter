<x-guest-layout>
    <div class="grid grid-cols-12 gap-5 px-6 pt-6" style="padding-bottom: calc(22%)">
        {{-- Notification --}}
        <div class="col-span-12">
            <div class="p-2">
                <div class="inline-flex items-center bg-white leading-none text-lime-900 border-opacity-95 rounded-full p-2 px-4 shadow text-teal md:text-sm text-xs">
                    <span class="flex bg-lime-900 opacity-95 text-white rounded-full h-6 px-3 justify-center items-center">Aviso</span>
                    <span class="py-2 px-2">Recuerda estar atento a la respuesta para saber la situación de tu solicitud.</span>
                </div>
            </div>
        </div>
        {{-- Cards --}}
        <div class="col-span-12">
            <div class="h-full bg-white shadow-lg mx-auto border-b-4 border-lime-500 rounded-2xl overflow-hidden hover:shadow-2xl transition duration-500">
                <div class="bg-lime-500  flex h-16 items-center">
                    <p class="ml-4 text-white uppercase">Solicitud enviada correctamente</p>
                </div>
                <div class="p-6">
                    <p class="leading-6 text-lg my-2">
                        Revisaremos la información y en breve un facilitador se pondrá en contacto para indicarte el siguiente paso. También puedes comunicarte con nosotros al <a class="text-green-600" target="_blank" href="https://wa.link/eekfh9">(+591) 65069921</a>. Muchas gracias por tu preferencia! <b>Hauscenter eCommerce.</b>
                    </p>
                    <div class="flex justify-end items-center">
                            <a href="{{ url('/') }}" class="h-full bg-green-500 text-white font-bold rounded-full border-b-2 border-green-500 hover:border-green-600 hover:bg-green-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                                <span class="mr-2">Ir a Inicio</span>
                            </a>
                    </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
