<x-guest-layout>
    <div class="my-4 mx-6">
        <form action="{{ route('upload_file_dependent_store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="grid grid-cols-4 lg:gap-10 md:gap-6 gap-4">
                @php
                    $inputs = [
                        [
                            'id' => 'ci1',
                            'title' => 'Cédula de identidad anverso*',
                            'description' => 'Ingresa una imagen o pdf de la cédula de identidad del lado anverso.',
                        ],
                        [
                            'id' => 'ci2',
                            'title' => 'Cédula de identidad reverso*',
                            'description' => 'Ingresa una imagen o pdf de la cédula de identidad del lado reverso.',
                        ],
                        [
                            'id' => 'cre',
                            'title' => 'Factura CRE*',
                            'description' => 'Ingresa una imagen o pdf de la última factura de cre.',
                        ],
                        [
                            'id' => 'afp',
                            'title' => 'Extracto de AFP',
                            'description' => 'Ingresa una imagen o pdf del extracto de tu extracto de la AFP.',
                        ],
                        [
                            'id' => 'pago1',
                            'title' => 'Última boleta de pago*',
                            'description' => 'Ingresa una imagen o pdf de tu última boleta de pago.',
                        ],
                        [
                            'id' => 'pago2',
                            'title' => 'Penúltima boleta de pago',
                            'description' => 'Ingresa una imagen o pdf de tu penúltima boleta de pago.',
                        ],
                        [
                            'id' => 'pago3',
                            'title' => 'Antepenúltima boleta de pago',
                            'description' => 'Ingresa una imagen o pdf de tu antepenúltima boleta de pago.',
                        ],
                    ];
                @endphp
                @foreach ($inputs as $item)
                <div class="lg:col-span-1 md:col-span-2 col-span-4">
                    <div class="bg-white border @error($item['id']) border-red-500 @enderror p-4 rounded-3xl h-full">
                        <div class="flex items-center flex-col ">
                            <div class="my-2 relative h-32 w-full sm:mb-0 mb-3">
                                <img class="w-full h-32 object-cover rounded-2xl" id="{{ $item['id'] }}"
                                    src="https://cdn.hauscenter.com.bo/no_imagen.jpg">
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="my-2">
                                    <div
                                        class="w-full text-lg text-gray-800 font-bold leading-none text-center">
                                        {{ $item['title'] }}</div>
                                    <p class="mt-2 leading-4 text-center">{{ $item['description'] }}
                                    </p>
                                    <p class="my-3 leading-4 font-semibold" id="result_{{ $item['id'] }}"></p>
                                    @error($item['id'])
                                        <p class="text-sm text-red-500 font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="input_{{ $item['id'] }}"
                                        class="text-center cursor-pointer uppercase text-bold bg-green-400 hover:bg-green-500 lg:px-8 px-20 ml-4 py-2 text-xs shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-green-300 hover:border-green-500 text-white rounded-full transition ease-in duration-300">
                                        SUBIR
                                    </label>
                                    <input type="file" name="{{ $item['id'] }}" id="input_{{ $item['id'] }}"
                                        class="hidden" onchange="load_file(event, '{{ $item['id'] }}')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
                <div class="col-span-4">
                    <div class="flex justify-end">
                        <button type="submit" class="h-full bg-green-500 text-white font-bold rounded-full border-b-2 border-green-500 hover:border-green-600 hover:bg-green-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                            <span class="mr-2">Finalizar</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentcolor" d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @push('script')
        <script>
            function load_file(e, name) {
                let extension = e.target.value.split('.')[e.target.value.split('.').length - 1].toLowerCase();
                console.warn(extension);
                if (extension === "pdf") {
                    let reader = new FileReader();
                    reader.readAsDataURL(e.target.files[0]);
                    reader.onload = function() {
                        let image = document.getElementById(`${name}`);
                        image.src = 'https://cdn.hauscenter.com.bo/pdf.png';
                        document.getElementById(`result_${name}`).innerHTML = 'PDF Detectado.';
                    };
                } else if (extension === "png" || extension === "jpg" || extension === "jpeg") {
                    let reader = new FileReader();
                    reader.readAsDataURL(e.target.files[0]);
                    reader.onload = function() {
                        let image = document.getElementById(`${name}`);
                        image.src = reader.result;
                        document.getElementById(`result_${name}`).innerHTML = 'Imagen Detectada.';
                    };
                } else if (extension == '') {
                    let image = document.getElementById(`${name}`);
                    image.src = 'https://cdn.hauscenter.com.bo/no_imagen.jpg';
                    document.getElementById(`result_${name}`).innerHTML = '<span class="text-red-500">Sin archivo.</span>';
                } else {
                    let image = document.getElementById(`${name}`)
                    image.src = 'https://cdn.hauscenter.com.bo/no_imagen.jpg';
                    document.getElementById(`result_${name}`).innerHTML =
                        '<span class="text-red-500">Error en el tipo de archivo.</span>';
                    document.getElementById(`input_${name}`).value = '';
                    return alert('Este documento tiene un formato incorrecto. Debes subir una imagen o un pdf.');
                }
            }
        </script>
    @endpush
</x-guest-layout>
