<x-guest-layout>
    <x-banner></x-banner>
    <section class="bg-white">
        <div class="py-4 px-6">
            <div class="grid grid-cols-12 gap-4">
                <div class="lg:col-span-4 md:col-span-6 col-span-12">
                    <div class="bg-gray-700 bg-opacity-90 shadow-lg rounded-3xl py-8 px-4 h-full">
                        <div class="flex justify-between">
                            <div class="flex flex-col place-content-between">
                                <div class="">
                                    <p class="font-semibold text-base text-gray-600 tracking-tight"><span
                                            class="px-2 bg-white rounded-lg">Muy pronto...</span></p>
                                    <p class="font-semibold text-xl text-white tracking-tight">Pagos Digitales</p>
                                    <p class="text-sm text-white">Podrás pagar tu cuota con tu tarjeta de débito,
                                        crédito y realizar pagos por Qr.</p>
                                </div>
                            </div>
                            <img class="w-44 object-contain" src="https://cdn.hauscenter.com.bo/credito/card3.png">
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-4 md:col-span-6 col-span-12">
                    <div class="bg-white border border-gray-400 bg-opacity-90 shadow-lg rounded-3xl py-8 px-4 h-full">
                        <div class="flex justify-between">
                            <div class="flex flex-col">
                                <div class="mb-auto">
                                    <p class="font-semibold text-xl text-gray-800 tracking-tight">Pagos en Sucursales
                                    </p>
                                    <p class="text-sm">Paga tu cuota en tu sucursal favorita o la más cercana.</p>
                                </div>
                                <a href="{{ route('branch_offices') }}"
                                    class="border border-gray-400 rounded-lg inset-0 text-sm leading-3 text-center text-black py-2 px-6 w-full hover:bg-gray-700 hover:text-white">Ver
                                    Sucursales</a>
                            </div>
                            <img class="w-44 object-contain" src="https://cdn.hauscenter.com.bo/credito/card2.png">
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-4 md:col-span-6 col-span-12">
                    <div class="bg-gray-700 bg-opacity-90 shadow-lg rounded-3xl py-8 px-4 h-full">
                        <div class="flex justify-between">
                            <div class="flex flex-col place-content-between">
                                <div class="">
                                    <p class="font-semibold text-xl text-white leading-5">Solicitar Cobrador a Domicilio
                                    </p>
                                    <p class="text-sm text-white">Solicita un cobrador para poder realizar tus pagos.
                                    </p>
                                </div>
                                <a href="#"
                                    class="border border-white rounded-lg inset-0 text-sm leading-3 text-center text-white py-2 px-6 w-full hover:bg-white hover:text-gray-800">Solicitar</a>
                            </div>
                            <img class="w-44 object-contain" src="https://cdn.hauscenter.com.bo/credito/card1.png">
                        </div>
                    </div>
                </div>
                <div class="col-span-12">
                    <img class="w-full object-cover rounded-lg"
                        src="https://cdn.hauscenter.com.bo/credito/banner/agosto01.jpg" alt="" srcset="">
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
