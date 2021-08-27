<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <section class="mx-4 my-6">
        <div class="bg-white rounded-lg shadow-lg py-6 px-4 overflow-y-auto">
            <div class="flex justify-between my-3">
                <span class="text-3xl">Solicitudes</span>
            </div>
            <table class="table table-auto w-full">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">CODIGO</th>
                        <th class="py-3 px-6 text-left">NOMBRE COMPLETO</th>
                        <th class="py-3 px-6 text-left">CI</th>
                        <th class="py-3 px-6 text-left">CELULAR</th>
                        <th class="py-3 px-6 text-left">TIPO</th>
                        <th class="py-3 px-6 text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($data as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $item->id }}</td>
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $item->fullname }}</td>
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $item->ci }} {{ $item->exp }}</td>
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $item->cellphone }}</td>
                            <td class="py-3 px-6 text-left whitespace-nowrap uppercase">{{ $item->type }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="{{ route('show', $item->id) }}">
                                        <div
                                            class="w-6 mr-2 transform hover:text-blue-500 hover:scale-110 cursor-pointer">
                                            <i class="fa fa-search"></i>
                                        </div>
                                    </a>
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
            <div class="py-4 px-2">
                {{ $data->links() }}
            </div>
        </div>
    </section>
</x-app-layout>
