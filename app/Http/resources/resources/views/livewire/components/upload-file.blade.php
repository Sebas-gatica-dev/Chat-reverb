<div>
    <div x-data="{ isDragging: false, uploading: false, progress: 0 }" @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false"
        @drop.prevent="isDragging = false; handleDrop($event)" @paste.prevent="handlePaste($event)"
        x-on:livewire-upload-start="uploading = true" x-on:livewire-upload-finish="uploading = false"
        x-on:livewire-upload-cancel="uploading = false" x-on:livewire-upload-error="uploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
        >

        @if ((!$files && count($existingFiles) == 0) || $multiple)
            <div class="mt-2 flex justify-center w-full rounded-lg border border-dashed border-gray-900/25 px-6 py-10"
                :class="{ 'border-blue-500': isDragging, 'border-gray-900/25': !isDragging }">
                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                            clip-rule="evenodd" />
                    </svg>
                    <div class="mt-4 flex text-sm leading-6 text-center text-gray-600 justify-center">
                        <label for="files-{{ $name }}"
                            class="relative cursor-pointer text-center rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                            <span>Subir {{ $multiple ? 'archivos' : 'archivo' }}</span>
                            <input type="file" id="files-{{ $name }}" name="files" class="sr-only"
                                {{ $multiple ? 'multiple' : '' }} x-ref="inputFile"
                                wire:model="{{ $multiple == false ? 'files' : 'newFiles' }}">

                        </label>
                        <p class="pl-1">o arrastrar y soltar</p>

                    </div>
                    <p class="text-xs leading-5 text-gray-600">Tipo de archivos permitidos: {{ implode(', ', $types) }}.
                        Máx. tamaño: {{ $maxSize / 1024 }}MB</p>


                </div>
            </div>

            <div x-show="uploading" class="" x-cloak>
                <div class="overflow-hidden rounded-full bg-gray-200 mt-2">
                    <div class="h-2 rounded-full bg-indigo-600" style="width: 0%"
                        x-bind:style="{ width: progress + '%' }"></div>
                </div>
                <div class="mt-2 text-indigo-600 text-sm text-right">

                    <span x-text="progress + '%'"></span>
                </div>
            </div>
        @endif
        @if ($showPreview)
            {{-- @dd($files) --}}
            @if ($multiple && ($files || count($existingFiles) > 0))
           
            {{-- @dump($files) --}}
                <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">
                    @foreach ($files as $index => $file)
                        <div class="sm:col-span-4">
                            <div
                                class="relative mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 p-6">
                                <button wire:click="removeFile('{{ $index }}')" x-on:click="progress = 0"
                                    class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>

                                {{-- App\Enums\ExtensionsEnum::getExtension($file->extension()) --}}

                            

                        
                                @if ($this->getTypeByExtension($file->extension()) == 'image')
                                    <img src="{{ $file->temporaryUrl() }}"
                                        class="h-48 w-full object-cover object-center">
                                @elseif($this->getTypeByExtension($file->extension()) == 'video')
                                    <video class="h-48 w-full object-cover object-center" controls>
                                        <source src="{{ $file->temporaryUrl() }}" type="video/{{ $file->extension() }}">
                                    </video>
                                @elseif($this->getTypeByExtension($file->extension()) == 'audio')
                                    <div class="relative h-48 w-full bg-contain bg-no-repeat bg-center"
                                        style="background-image: url('{{ asset('icons/' . $file->extension() . '.png') }}');">
                                        <audio class="absolute bottom-0 left-0 w-full" controls>
                                            <source src="{{ $file->temporaryUrl() }}"
                                                type="audio/{{ $file->extension() }}">
                                        </audio>
                                    </div>
                                @else
                                    <img src="{{ asset('icons/' . $file->extension() . '.png') }}"
                                        class="h-48 w-full object-contain object-center">
                                @endif

                            </div>
                            <p class="text-xs leading-5 text-gray-600">
                                {{ $file->getClientOriginalName() }}</p>

                        </div>
                    @endforeach

                    @if (count($existingFiles) > 0)
                    
                        @foreach ($existingFiles as $index => $existingFile)
                            <div class="sm:col-span-4">
                                <div
                                    class="relative mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 p-6 ">
                                    <button wire:click="removeFileExisting('{{ $index }}')"
                                        class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>

                                    @if ($this->getTypeByExtension($existingFile['extension']) == 'image')
                                        <img src="{{ $existingFile['path'] }}"
                                            class="h-48 w-full object-cover object-center">
                                    @elseif($this->getTypeByExtension($existingFile['extension']) == 'video')
                                        <video class="h-48 w-full object-cover object-center" controls>
                                            <source src="{{ $existingFile['path'] }}"
                                                type="video/{{ $existingFile['type'] }}">
                                        </video>
                                    @elseif($this->getTypeByExtension($existingFile['extension']) == 'audio')
                                        <div class="relative h-48 w-full bg-contain bg-no-repeat bg-center"
                                            style="background-image: url('{{ asset('icons/' . $existingFile['type'] . '.png') }}');">
                                            <audio class="absolute bottom-0 left-0 w-full" controls>
                                                <source src="{{ $existingFile['path'] }}"
                                                    type="audio/{{ $existingFile['type'] }}">
                                            </audio>
                                        </div>
                                    @elseif($this->getTypeByExtension($existingFile['extension']) == 'document')
                                        <img src="{{ asset('icons/' . $existingFile['extension'] . '.png') }}"
                                            class="h-48 w-full object-contain object-center">
                                    @endif

                                </div>
                                <p class="text-xs leading-5 text-gray-600"> {{ $existingFile['name'] }} </p>

                            </div>
                        @endforeach
                    @endif




                </div>
            @else
                @if ($files && count($existingFiles) == 0)
                    <div class="sm:col-span-4">
                        <div
                            class="relative mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 p-6">
                            <button wire:click="removeFile(0)" x-on:click="progress = 0"
                                class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            @if ($this->getTypeByExtension($files[0]->extension()) == 'image')
                                <img src="{{ $files[0]->temporaryUrl() }}"
                                    class="h-48 w-full object-cover object-center">
                            @elseif($this->getTypeByExtension($files[0]->extension()) == 'video')
                                <video class="h-48 w-full object-cover object-center" controls>
                                    <source src="{{ $files[0]->temporaryUrl() }}"
                                        type="video/{{ $files[0]->extension() }}">
                                </video>
                            @elseif($this->getTypeByExtension($files[0]->extension()) == 'audio')
                                <div class="relative h-48 w-full bg-contain bg-no-repeat bg-center"
                                    style="background-image: url('{{ asset('icons/' . $files[0]->extension() . '.png') }}');">
                                    <audio class="absolute bottom-0 left-0 w-full" controls>
                                        <source src="{{ $files[0]->temporaryUrl() }}"
                                            type="audio/{{ $files[0]->extension() }}">
                                    </audio>
                                </div>
                            @else
                                <img src="{{ asset('icons/' . $files[0]->extension() . '.png') }}"
                                    class="h-48 w-full object-contain object-center">
                            @endif

                      
                        </div>
                        <p class="text-xs leading-5 text-gray-600">
                            {{ $files[0]->getClientOriginalName() }}</p>
                    </div>
                @elseif(count($existingFiles) == 1)
                    <div class="sm:col-full">
                        <div
                            class="relative mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 p-6">
                            <button wire:click="removeFileExisting(0)"
                                class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                          
                            <img src="{{ $existingFiles[0] }}" class="h-48 w-full object-cover object-center">
                            {{-- @if (in_array($existingFiles[0]['type'], ['jpg', 'jpeg', 'png', 'gif']))
                                    <img src="{{ $existingFiles[0]['path'] }}"
                                        class="h-48 w-full object-cover object-center">
                                @elseif(in_array($existingFiles[0]['type'], ['mp4', 'avi', 'mov', 'wmv', 'flv', '3gp', 'mkv']))
                                    <video class="h-48 w-full object-cover object-center" controls>
                                        <source src="{{ $existingFiles[0]['path'] }}"
                                            type="video/{{ $existingFiles[0]['type'] }}">
                                    </video>
                                @elseif(in_array($existingFiles[0]['type'], ['mp3', 'wav', 'ogg', 'm4a', 'flac', 'aac', 'wma']))
                                    <div class="relative h-48 w-full bg-contain bg-no-repeat bg-center"
                                        style="background-image: url('{{ asset('icons/' . $existingFiles[0]['type'] . '.png') }}');">
                                        <audio class="absolute bottom-0 left-0 w-full" controls>
                                            <source src="{{ $existingFiles[0]['path'] }}"
                                                type="audio/{{ $existingFiles[0]['type'] }}">
                                        </audio>
                                    </div>
                                @else
                                    <img src="{{ asset('icons/' . $existingFiles[0]['type'] . '.png') }}"
                                        class="h-48 w-full object-contain object-center">
                                @endif --}}

                        </div>
                    </div>
                @endif


            @endif
        @endif
        @error($multiple ? 'newFiles.*' : 'files')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror

    </div>



    {{-- <script>
        document.addEventListener('livewire:init', () => {
              // Obtener la variable multiple desde Livewire
              var isMultiple = '{{ $multiple }}';

              // Obtener el input por su ID
              var fileInput = document.getElementById('files');

              // Si multiple es true, agregar el atributo multiple al input
              if (isMultiple) {
                  fileInput.setAttribute('multiple', 'true');
              }
          });
      </script> --}}

    <script>
        function handleDrop(event) {
            let files = event.dataTransfer.files;
            let input = document.querySelector('input[type="file"]');
            input.files = files;
            input.dispatchEvent(new Event('change', {
                bubbles: true
            }));
        }

        function handlePaste(event) {
            let items = (event.clipboardData || event.originalEvent.clipboardData).items;
            for (let i = 0; i < items.length; i++) {
                if (items[i].kind === 'file') {
                    let file = items[i].getAsFile();
                    let input = document.querySelector('input[type="file"]');
                    let dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    input.files = dataTransfer.files;
                    input.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                    break;
                }
            }
        }
    </script>




</div>
