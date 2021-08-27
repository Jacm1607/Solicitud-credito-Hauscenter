<x-app-layout>
    <section class="mx-4 my-6">
        <div class="bg-white rounded-lg shadow-lg py-6 px-4 overflow-y-auto">
            <div class="flex justify-between my-3">
                <span class="text-3xl">Detalle de solicitud</span>
            </div>
            <div class="grid grid-cols-12 gap-6">
                <div class="lg:col-span-3 md:col-span-3 col-span-12">
                    <x-jet-label value="Nombre(s) completo"/>
                    <x-jet-input class="block mt-1 w-full" type="text" value="{{ $data->fullname }}" disabled="disabled" />
                </div>
                <div class="lg:col-span-3 md:col-span-3 col-span-12">
                    <x-jet-label value="CI"/>
                    <x-jet-input class="block mt-1 w-full" type="text" value="{{ $data->ci }} {{ $data->exp }}" disabled="disabled" />
                </div>
                <div class="lg:col-span-3 md:col-span-3 col-span-12">
                    <x-jet-label value="Celular"/>
                    <x-jet-input class="block mt-1 w-full" type="text" value="{{ $data->cellphone }}" disabled="disabled" />
                </div>
                <div class="lg:col-span-3 md:col-span-3 col-span-12">
                    <x-jet-label value="Tipo"/>
                    <x-jet-input class="block mt-1 w-full uppercase" type="text" value="{{ $data->type }}" disabled="disabled" />
                </div>
                <div class="lg:col-span-3 md:col-span-3 col-span-12">
                    <x-jet-label value="Monto"/>
                    <x-jet-input class="block mt-1 w-full uppercase" type="text" value="{{ $data->mount }}" disabled="disabled" />
                </div>
                <div class="lg:col-span-3 md:col-span-3 col-span-12">
                    <x-jet-label value="Alquiler"/>
                    <x-jet-input class="block mt-1 w-full uppercase" type="text" value="{{ $data->rental }}" disabled="disabled" />
                </div>
                <div class="lg:col-span-3 md:col-span-3 col-span-12">
                    <x-jet-label value="Crédito comercial"/>
                    <x-jet-input class="block mt-1 w-full uppercase" type="text" value="{{ $data->credit_commercial }}" disabled="disabled" />
                </div>
                <div class="lg:col-span-3 md:col-span-3 col-span-12">
                    <x-jet-label value="Crédito financiero"/>
                    <x-jet-input class="block mt-1 w-full uppercase" type="text" value="{{ $data->credit_finance }}" disabled="disabled" />
                </div>
                <div class="col-span-12">
                    <x-jet-label value="Producto"/>
                    <x-jet-input class="block mt-1 w-full uppercase" type="text" value="{{ $data->product }}" disabled="disabled" />
                </div>
            </div>
            <hr class="w-full my-3">
            <table class="table table-auto w-full">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">NOMBRE DEL ARCHIVO</th>
                        <th class="py-3 px-6 text-left">TIPO</th>
                        <th class="py-3 px-6 text-center">ACCION</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($files as $file)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ basename($file) }}</td>
                            <td class="py-3 px-6 text-left whitespace-nowrap uppercase">
                                @php
                                    echo pathinfo($file, PATHINFO_EXTENSION);
                                @endphp
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    {{-- <a href="{{ route('show', $item->id) }}">
                                        <div
                                            class="w-6 mr-2 transform hover:text-yellow-500 hover:scale-110 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                    </a> --}}
                                    <a href="{{ route('download_file', ['file' => $file]) }}" >Descargar</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center font-semibold text-gray-400 text-3xl py-4" colspan="5">SIN REGISTROS
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-app-layout>
