<div>


    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 -mx-4 sm:mx-0 px-6 pb-6 pt-4 rounded-b-lg">

        @can('access-function','property-file-add')
            <livewire:components.upload-file :multiple="true" :types="['image','video','audio','document']" :showPreview="false" :name="'property-files'">
        @endcan

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-6">
           
          
                @forelse($files->toArray() as $file)
                    <div class="relative group content-center">
                
                   

                        @if ($file['type'] == 'image')
                            <img src="{{ $file['path'] }}" class="h-auto w-full object-contain object-center rounded-lg"
                                alt="{{ $file['name'] }}">
                        @elseif($file['type'] == 'video')
                            <video class="h-48 w-full rounded-lg" controls>
                                <source src="{{ $file['path'] }}" type="video/{{ $file['extension'] }}">
                            </video>
                        @elseif($file['type'] == 'audio')
                            <div class="relative h-auto w-full rounded-lg bg-contain bg-no-repeat bg-center"
                                style="background-image: url('{{ asset('icons/' . $file['extension'] . '.png') }}');">
                                <audio class="absolute bottom-0 left-0 w-full" controls>
                                    <source src="{{ $file['path'] }}" type="audio/{{ $file['extension'] }}">
                                </audio>
                            </div>
                        @else
                            {{-- <a href="{{ $file['path'] }}" target = "_blank"> --}}
                                <img src="{{ asset('icons/' . $file['extension'] . '.png') }}"
                                    class="h-auto w-full object-contain object-center rounded-lg"
                                    alt="{{ $file['name'] }}">

                            {{-- </a> --}}
                        @endif



                        <!-- Badge en la esquina superior izquierda -->
                        <div class="absolute top-2 left-2 bg-blue-500 text-white text-xs px-2 py-1 rounded-full">
                            {{ $file['fileable_type'] == 'App\Models\Comment' ? 'Comentario' : 'Propiedad' }}
                        </div>

                        <!-- Icono de cerrar -->

                       
                        @can('access-function','property-file-delete')
                       
                            <div
                                class="absolute top-2 right-2 hidden group-hover:flex items-center justify-center bg-red-500 text-white rounded-full w-6 h-6 cursor-pointer" wire:click="deleteFile('{{ $file['id'] }}')"
                                wire:confirm = "¿Estás seguro de que deseas eliminar este archivo?"
                                >
                                &times;
                            </div>

                        @endcan

                      


                        <!-- Barra de información -->
                        <div
                            class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-sm p-2 opacity-0 group-hover:opacity-100 transition-opacity rounded-b-lg flex items-center">
                            <!-- Foto de usuario -->
                            <img class="w-6 h-6 rounded-full mr-2" src="{{ $file['user']['photo'] }}"
                                alt="{{ $file['user']['name'] }}">
                           <p class="hidden md:block">{{ $file['user']['name'] }}</p>
                        </div>

                        <!-- Enlace de descarga -->
                        <a href="{{ $file['path'] }}" download
                            class="absolute bottom-2 right-2 hidden group-hover:block bg-green-500 text-white text-xs px-2 py-1 rounded">
                            Descargar
                        </a>
                    </div>
                @empty

                        <div class="rounded-md bg-yellow-50 p-4 relative group content-center col-span-full">
                            <div class="text-sm font-medium text-yellow-700 text-center">
                                <p>Todavía no se han registrado archivos para esta propiedad.</p>
                            </div>
                        </div>

                @endforelse
            </div>

    </div>
</div>
