@section('css')
    <link href="{{asset('vendor/select2/css/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('js')
    <script src="{{asset('vendor/jquery/jquery-3.6.0.slim.min.js')}}"></script>
    <script src="{{asset('vendor/select2/js/select2.min.js')}}"></script>
@endsection
<x-guest-layout>
    <form action="{{ route('solicit_credit_store') }}" method="post" autocomplete="off">
        @csrf
        <div class="grid grid-cols-12 gap-5 px-6 py-3 mt-3">
            {{-- Notification --}}
            <div class="col-span-12">
                <div class="p-2">
                    <div class="inline-flex items-center bg-white leading-none text-yellow-700 border-opacity-95 rounded-full py-2 px-4 shadow text-teal md:text-sm text-xs">
                        <span class="flex items-center bg-yellow-500 opacity-95 text-white rounded-full h-6 px-3 justify-center">Ayuda</span>
                        <span class="py-2 px-2">
                            Tienes problema para solicitar tu crédito?...Contáctanos haciendo<a href="https://wa.me/message/N3LZY6C5B674L1" target="_blank" class="font-bold">&nbsp;<span class="text-black">click aquí</span>&nbsp;</a>.
                        </span>
                    </div>
                </div>
                <div class="p-2">
                    <div class="inline-flex items-center bg-white leading-none text-sky-900 border-opacity-95 rounded-full p-2 px-4 shadow text-teal md:text-sm text-xs">
                        <span class="flex bg-sky-900 opacity-95 text-white rounded-full h-6 px-3 justify-center items-center">Aviso</span>
                        <span class="py-2 px-2">Completa todos los campos requeridos para poder iniciar una solicitud.</span>
                    </div>
                </div>
            </div>
            {{-- Cards --}}
            <div class="lg:col-span-8 md:col-span-6 col-span-12">
                <div class="h-full bg-white shadow-lg mx-auto border-b-4 border-sky-900 border-opacity-95 rounded-2xl overflow-hidden hover:shadow-2xl transition duration-500">
                    <div class="bg-sky-900 opacity-95 flex h-16  items-center">
                        <h1 class="text-white ml-4 border-2 py-1 px-3 rounded-full">1</h1>
                        <p class="ml-4 text-white uppercase">Información Básica</p>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="lg:col-span-5 col-span-12">
                                <x-jet-label for="fullname" value="Nombre(s) completo<span class='text-red-500'>*</span>" />
                                <x-jet-input id="fullname" class="block mt-1 w-full" type="text" name="fullname" placeholder="Ingrese nombre completo" value="{{ old('fullname') }}" required autofocus />
                                <x-jet-input-error for="fullname" />
                            </div>
                            <div class="lg:col-span-3 col-span-12">
                                <x-jet-label for="ci" value="CI<span class='text-red-500'>*</span>" />
                                <x-jet-input id="ci" min="1" class="block mt-1 w-full" type="number" name="ci" value="{{ old('ci') }}" required autofocus />
                                <x-jet-input-error for="ci" />
                            </div>
                            <div class="lg:col-span-4 col-span-12">
                                <x-jet-label for="exp" value="EXP<span class='text-red-500'>*</span>" />
                                <select name="exp" id="exp" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required>
                                    @php
                                        $exp = [['id' => 'SC', 'name' => 'SANTA CRUZ'], ['id' => 'CH', 'name' => 'CHUQUISACA'], ['id' => 'LP', 'name' => 'LA PAZ'], ['id' => 'CB', 'name' => 'COCHABAMBA'], ['id' => 'OR', 'name' => 'ORURO'], ['id' => 'PT', 'name' => 'POTOSÍ'], ['id' => 'TJ', 'name' => 'TARIJA'], ['id' => 'BE', 'name' => 'BENI'], ['id' => 'PD', 'name' => 'PANDO']];
                                    @endphp
                                    <option value="" selected hidden>Seleccione una opción</option>
                                    @foreach ($exp as $item)
                                        <option value="{{ $item['id'] }}" {{ old('exp') == $item['id'] ? 'selected' : '' }}> {{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="exp" />
                            </div>
                            <div class="lg:col-span-4 col-span-12">
                                <x-jet-label for="cellphone" value="Celular<span class='text-red-500'>*</span>" />
                                <x-jet-input id="cellphone"  min="1" class="block mt-1 w-full" type="number" name="cellphone" value="{{ old('cellphone') }}" required autofocus />
                                <x-jet-input-error for="cellphone" />
                            </div>
                            <div class="lg:col-span-4 col-span-12">
                                <x-jet-label for="type" value="Tipo de persona<span class='text-red-500'>*</span>" />
                                <select name="type" id="type" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required>
                                    @php
                                        $type_persons = [['type' => 'dependiente'], ['type' => 'independiente']];
                                    @endphp
                                    <option value="" selected hidden>Seleccione una opción</option>
                                    @foreach ($type_persons as $item)
                                        <option value="{{ $item['type'] }}" {{ old('type') == $item['type'] ? 'selected' : '' }}>{{ Str::ucfirst($item['type']) }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="type" />
                            </div>
                            <div class="lg:col-span-4 col-span-12">
                                <x-jet-label for="product" value="Producto(s)<span class='text-red-500'>*</span>" />
                                <select name="product" id="product" class="w-full js-example-basic-single" required>
                                    @if (!isset($_GET['token']) && !isset($_GET['product']))
                                        <option value="" disabled selected>Seleccione una opción</option>
                                    @endif
                                    @foreach ($product as $item)
                                        <option value="{{ $item->description }}" {{ old('product') == $item->description ? 'selected' : '' }}>{{ Str::limit($item->description, 25, '...') }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="product" />
                                <script>
                                    $(document).ready(function() {
                                        $('.js-example-basic-single').select2();
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <div class="h-full bg-white shadow-lg mx-auto border-b-4 border-sky-900 border-opacity-95 rounded-2xl overflow-hidden hover:shadow-2xl transition duration-500">
                    <div class="bg-sky-900 opacity-95 flex h-16 items-center">
                        <h1 class="text-white ml-4 border-2 py-1 px-3 rounded-full">2</h1>
                        <p class="ml-4 text-white uppercase">Información Financiera</p>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-4 gap-4">
                            <div class="md:col-span-2 col-span-4">
                                <x-jet-label for="mount" value="Ingreso mensual<span class='text-red-500'>*</span>" />
                                <x-jet-input id="mount" min="1" class="block mt-1 w-full" type="number" name="mount" value="{{ old('mount') }}" required autofocus />
                                <x-jet-input-error for="mount" />
                            </div>
                            <div class="md:col-span-2 col-span-4">
                                <x-jet-label for="rental" value="Alquiler" />
                                <x-jet-input id="rental" min="0" class="block mt-1 w-full" type="number" name="rental" placeholder="" value="{{ old('rental') ?? '0' }}" autofocus />
                                <p class="text-xs text-gray-400">Si no paga alquiler mantenga el valor de <b>0</b>.</p>
                                <x-jet-input-error for="rental" />
                            </div>
                            <div class="md:col-span-2 col-span-4">
                                <x-jet-label for="credit_commercial" value="Créditos comerciales" />
                                <x-jet-input id="credit_commercial" min="0" class="block mt-1 w-full" type="number" name="credit_commercial" placeholder="" value="{{ old('credit_commercial') ?? '0' }}" autofocus />
                                <p class="text-xs text-gray-400">Si no tiene créditos comerciales pendientes mantenga el valor de <b>0</b>.</p>
                                <x-jet-input-error for="credit_commercial" />
                            </div>
                            <div class="md:col-span-2 col-span-4">
                                <x-jet-label for="credit_finance" value="Créditos financieros" />
                                <x-jet-input id="credit_finance" min="0" class="block mt-1 w-full" type="number" name="credit_finance" placeholder="" value="{{ old('credit_commercial') ?? '0' }}" autofocus />
                                <p class="text-xs text-gray-400">Si no tiene créditos financieros pendientes mantenga el valor de <b>0</b>.</p>
                                <x-jet-input-error for="credit_finance" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12">
                <div class="h-full bg-white shadow-lg mx-auto border-b-4 border-red-500 rounded-2xl overflow-hidden hover:shadow-2xl transition duration-500">
                    <div class="bg-red-500  flex h-16 items-center">
                        <h1 class="text-white ml-4 border-2 py-1 px-3 rounded-full">3</h1>
                        <p class="ml-4 text-white uppercase">BURO DE INFORMACIÓN CREDITICIA (INFOCENTER)</p>
                    </div>
                    <div class="p-6">
                        <p class="leading-5"><span class="font-bold">Paso 1: </span>Descargue el documento de Aurotización de Buro de Información Crediticia.</p>
                        <p class="my-4">
                            <a href="{{ route('download_pdf') }}" class="py-2 px-4 bg-cyan-600 text-white rounded-lg">Descargar documento <i class="fas fa-cloud-download-alt animate-bounce"></i></a>
                        </p>
                        <p class="leading-5"><span class="font-bold">Paso 2: </span> Imprime el documento en una hoja limpia y de color blanco.</p>
                        <p class="leading-5">
                            <span class="font-bold">Paso 3: </span> Coloca los siguientes datos en el orden correspondiente:
                            <ul class="ml-4">
                                <li>- Firma.</li>
                                <li>- Nombre completo.</li>
                                <li>- Número de tu cedula de identidad.</li>
                            </ul>
                            <span class="font-bold">Nota: Tus datos debes realizarlo con bolígrafo color azul.</span>
                        </p>
                        <p class="my-2">
                            <div class="flex justify-between items-center">
                                <div class="">
                                    {{-- <div class="flex">
                                        <label class="text-xs uppercase mr-6">Sí, acepto</label>
                                        <button type="button"
                                            class="w-9 h-4 rounded-full bg-gray-300 flex items-center transition duration-300 focus:outline-none shadow"
                                            onclick="toggleTheme()">
                                            <div id="switch-toggle"
                                                class="w-5 h-5 animate-pulse relative rounded-full transition duration-500 transform bg-gray-500 -translate-x-2 p-1 text-white">
                                            </div>
                                            <input type="checkbox" class="hidden" name="infocenter" id="input_infocenter">
                                        </button>
                                    </div>
                                    @error('infocenter')
                                        <small class="rounded-lg bg-red-700 text-white font-bold px-3">{{ $message }}</small>
                                    @enderror --}}
                                </div>
                                <div class="">
                                    <button type="submit" class="h-full bg-green-500 text-white font-bold rounded-full border-b-2 border-green-500 hover:border-green-600 hover:bg-green-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                                        <span class="mr-2">Continuar</span>
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path fill="currentcolor" d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
                                        </svg> --}}
                                    </button>
                                    {{-- <script>
                                        const switchToggle = document.querySelector('#switch-toggle');
                                        const infocenter = document.getElementById('input_infocenter');
                                        let isCheck = false;

                                        function toggleTheme() {
                                            isCheck = !isCheck
                                            infocenter.checked = !infocenter.checked
                                            switchTheme()
                                        }

                                        function switchTheme() {
                                            if (isCheck) {
                                                switchToggle.classList.remove('bg-gray-400', '-translate-x-2')
                                                switchToggle.classList.add('bg-lime-400', 'translate-x-full')
                                                setTimeout(() => {
                                                    switchToggle.classList.remove('animate-pulse')
                                                }, 250);
                                            } else {
                                                switchToggle.classList.add('bg-gray-400', '-translate-x-2')
                                                switchToggle.classList.remove('bg-lime-400', 'translate-x-full')
                                                setTimeout(() => {
                                                    switchToggle.classList.add('animate-pulse')
                                                }, 250);
                                            }
                                        }
                                    </script> --}}
                                </div>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>
