<div x-data="{ openComments: @entangle('isOpen') }" @click.away="openComments = false">
    <div class="mx-auto text-center">
        {{-- @can('access-function', 'visit-comment-list') --}}
        <h2 class="text-sm font-medium text-indigo-600 hover:text-indigo-500 cursor-pointer"
            x-on:click="openComments = !openComments; if (openComments) @this.loadComments()">
            @if ($comments->count() > 0)
                <span x-text="openComments ? 'Ocultar comentarios' : 'Ver comentarios'"></span>
            @else
                <span x-text="openComments ? 'Ocultar formulario' : 'Agregar comentario'"></span>
            @endif
            <span aria-hidden="true" x-html="openComments ? '&uarr;' : '&darr;'"></span>
        </h2>
        {{-- @endcan --}}
    </div>


    <div class="flow-root mt-6" x-show="openComments" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95" x-cloak>

        <ul role="list" class="-mb-8">
            @foreach ($comments as $comment)
               
                <li  wire:key="comment-{{ $comment->id }}">
                    <div class="relative pb-8">
                        @if (!$loop->last)
                            <span class="absolute left-5 top-5 -ml-px h-full w-0.5 bg-gray-200"
                                aria-hidden="true"></span>
                        @endif
                        <div class="relative flex items-start space-x-3" x-data="{ editComment: false, editCommentSuccess: @entangle('editCommentSuccess') }"
                            x-effect="if (editCommentSuccess) { editComment = false; editCommentSuccess = false;}">
                            <div class="relative">
                                <img class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-400 ring-white"
                                    src="{{ $comment->user->photo }}" alt="{{ $comment->user->name }}">
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-sm">
                                            <a href="#"
                                                class="font-medium text-gray-900">{{ $comment->user->name }}</a>
                                        </div>
                                        <p class="mt-0.5 text-sm text-gray-500">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </p>
                                    </div>

                                    <div class="flex flex-row">
                                    @if (($comment->user_id == auth()->id() || auth()->user()->can('access-function', 'visit-edit-any-comment')) && auth()->user()->can('access-function', 'visit-comment-edit'))
                                        <div class="me-2">
                                           
                                                <button type="button" wire:click="editComment('{{ $comment->id }}')"
                                                    @click="editComment = !editComment"
                                                    class="rounded bg-white px-2 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="h-4 w-4 text-gray-400">
                                                        <path
                                                            d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                                    </svg>
                                                </button>
                                        

                                        </div>
                                    @endif
                                    @if (($comment->user_id == auth()->id() || auth()->user()->can('access-function', 'visit-delete-any-comment')) && auth()->user()->can('access-function', 'visit-delete-comment'))
                                    <div class="me-2">
                                       
                                            <button type="button" wire:click="removeComment('{{ $comment->id }}')"
                                                   wire:confirm="¿Estás seguro de que deseas eliminar este comentario?"
                                                class="rounded bg-white px-2 py-1 text-xs  font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                                  </svg>
                                                  
                                            </button>
                                    

                                    </div>
                                @endif
                            </div>
                                </div>
                                <div class="mt-2 text-sm text-gray-700">
                                    <p x-show="!editComment">{{ $comment->message }}</p>
                                    @if (($comment->user_id == auth()->id() || auth()->user()->can('access-function', 'visit-edit-any-comment')) && auth()->user()->can('access-function', 'visit-comment-edit'))
                                        <div x-show="editComment" @click.away="editComment = false">
                                            <div class="relative flex-auto">
                                                <div
                                                    class="overflow-hidden bg-white rounded-lg pb-12 shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600">
                                                    <label for="editMessage" class="sr-only">Editar comentario</label>
                                                    <textarea rows="2" wire:model="editMessage" id="editMessage"
                                                        class="block w-full resize-none border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                        placeholder="Agregar un comentario...">{{ $comment->message }}</textarea>
                                                </div>
                                                <div
                                                    class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">
                                                    <div class="flex items-center space-x-5">
                                                        <div class="flex items-center">
                                                            <div x-data>
                                                                <button type="button"
                                                                    class="-m-2.5 flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500"
                                                                    @click="$refs.editFileInput.click()">
                                                                    <svg class="h-5 w-5" viewBox="0 0 20 20"
                                                                        fill="currentColor" aria-hidden="true">
                                                                        <path fill-rule="evenodd"
                                                                            d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                                            clip-rule="evenodd" />
                                                                    </svg>
                                                                    <span class="sr-only">Adjuntar archivo</span>
                                                                </button>
                                                                <input multiple type="file" x-ref="editFileInput"
                                                                    style="display: none;" wire:model="editFiles">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button wire:click="updateComment('{{ $comment->id }}')"
                                                        class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Editar
                                                        comentario</button>
                                                </div>
                                            </div>
                                            @error('editMessage')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                            @error('editFiles')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endif
                                    @foreach ($comment->files as $file)
                                        <span

                                            class="inline-flex items-center gap-x-0.5 mt-2 mr-1 rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">
                                            <a href="{{ asset($file->path) }}"
                                                target="__blank">{{ Str::limit($file->name, 20) }}</a>
                                            <button type="button"
                                                class="group relative -mr-1 h-3.5 w-3.5 rounded-sm hover:bg-red-600/20"
                                                wire:click="removeFileComment('{{ $file->id }}')"
                                                wire:confirm="¿Estás seguro de eliminar el archivo?">
                                                <span class="sr-only">Remove</span>
                                                <svg viewBox="0 0 14 14"
                                                    class="h-3.5 w-3.5 stroke-red-600/50 group-hover:stroke-red-600/75">
                                                    <path d="M4 4l6 6m0-6l-6 6" />
                                                </svg>
                                                <span class="absolute -inset-1"></span>
                                            </button>
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>




                    </div>
                </li>
            @endforeach
        </ul>

        @if ($comments->hasMorePages())
            <div class="mt-6 text-center">
                <button wire:click="loadMore" type="button"
                    class="rounded bg-white px-2 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Cargar
                    más</button>
            </div>
        @endif

    <div class="w-full" wire:loading.remove wire:target="addComment" >
        @can('access-function', 'visit-comment-add')
            <div class="mt-6 flex gap-x-3 w-full">
                <img src="{{ auth()->user()->photo }}" alt="" class="h-6 w-6 flex-none rounded-full bg-gray-50">
                <div class="relative flex-auto">
                    <div
                        class="overflow-hidden bg-white rounded-lg pb-12 shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600">
                        <label for="message" class="sr-only">Agregar un comentario</label>
                        <textarea rows="2" wire:model="message" id="message"
                            class="block w-full resize-none border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                            placeholder="Agregar un comentario..."></textarea>
                    </div>

                    <div class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">
                        <div class="flex items-center space-x-5">
                            <div class="flex items-center">

                                <div x-data>
                                    <button type="button"
                                        class="-m-2.5 flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500"
                                        @click="$refs.fileInput.click()">
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="sr-only">Adjuntar archivo</span>
                                    </button>

                                    <input multiple type="file" x-ref="fileInput" style="display: none;"
                                        wire:model="newFiles">
                                </div>



                            </div>
                        </div>

                        <button wire:click="addComment"
                            class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Comentar</button>

                    </div>



                </div>



            </div>
        @endcan


        @if ($files)


            <div class="relative flex items-center space-x-3 my-2 ml-10" x-data="{ open: false }">
                @foreach ($files as $file)
                    <span class="inline-flex items-center gap-x-0.5 mt-2 mr-1 rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">
                      <span class="cursor-pointer" @click="open = true">{{ Str::limit($file->getClientOriginalName(), 20) }}</span>  

                        <button type="button" class="group relative -mr-1 h-3.5 w-3.5 rounded-sm hover:bg-red-600/20"
                            wire:click="removeFile('{{ $loop->index }}')"
                            wire:confirm="¿Estás seguro de eliminar el archivo?">
                            <span class="sr-only">Remove</span>
                            <svg viewBox="0 0 14 14"
                                class="h-3.5 w-3.5 stroke-red-600/50 group-hover:stroke-red-600/75">
                                <path d="M4 4l6 6m0-6l-6 6" />
                            </svg>
                            <span class="absolute -inset-1"></span>
                        </button>

                    </span>



                    @if (in_array($file->extension(), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true"
                            x-show="open" x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0" x-cloak x-on:keydown.escape.window="open = false"
                            x-on:close-modal.window="open = false">

                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                aria-hidden="true"></div>

                            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                                <div
                                    class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                                    <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6"
                                        x-on:click.away="open = false">

                                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">

                                            <div class="col-span-full">
                                                <img src="{{ $file->temporaryUrl() }}" alt="Imagen del archivo"
                                                    class="w-full h-auto">
                                            </div>
                                        </div>

                                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                            <button type="button"
                                                class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:w-auto"
                                                x-on:click="open = false">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

        </div>
         <!-- Skeleton loader, visible durante la carga -->
        <div class="mt-6  flex gap-x-3 w-full" wire:loading wire:target="addComment">
            <!-- Imagen de usuario (skeleton) -->
            {{-- ACOMODAR EL CIRCULITO LO ANTES  --}}
            {{-- <div class="absolute h-6 w-6 flex-auto rounded-full bg-purple-100 animate-pulse"></div> --}}

            <!-- Formulario (skeleton) -->
            <div class="relative flex-auto">
                <div class="overflow-hidden rounded-lg pt-4 px-4 pb-14 shadow-sm ring-1 ring-inset ring-gray-300">
                    <!-- Skeleton del textarea -->
                    {{-- <div class="block w-full h-[52px] bg-purple-100 animate-pulse"></div> --}}
                    <div class="grid grid-cols-3 gap-4 mb-2">
                        <div class="h-2 bg-purple-100 rounded col-span-2"></div>
                        <div class="h-2 bg-purple-100 rounded col-span-1"></div>
                      </div>
                      <div class="h-2 bg-purple-100 rounded mb-3""></div>
        
                </div>

                <div class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">
                    <div class="flex items-center space-x-5">
                        <!-- Skeleton del botón de adjuntar archivo -->
                        <div class=" flex h-8 w-8 items-center justify-center rounded-full bg-purple-100 animate-pulse">
                        </div>
                    </div>

                    <!-- Skeleton del botón de comentar -->
                    <div class="rounded-md bg-purple-100 w-20 h-8 animate-pulse mr-2"></div>
                </div>
            </div>
        </div>

        @error('message')
            <span class="text-red-500 text-sm ml-10">{{ $message }}</span>
        @enderror
        @error('newFiles')
            <span class="text-red-500 text-sm ml-10">{{ $message }}</span>
        @enderror
    </div>
</div>
