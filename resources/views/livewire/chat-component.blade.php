<div class="">

<div class="flex-none h-16 w-full bg-white rounded-sm">


</div>




@if ($chatId)

    <div class="overflow-y-auto h-[calc(100vh-14rem)]">

        @forelse ($messages as $message)
            @if ($this->validateMessageOwner($message->user_id))
                <div class="flex justify-end relative" x-data="{ dropdownActionsOpen: false, updateFormMessage: false }">

                    <span class="bg-green-200 h-auto px-2 mb-4 rounded">

                        <div class="flex items-center">
                            @if ($message->path)
                                <div class="">
                                    <img class="object-cover" src="{{ asset('storage/' . $message->path) }}"
                                        alt="message image">
                                </div>
                            @endif

                            <div>
                                {{ $message->text }}
                            </div>

                            <button @click="dropdownActionsOpen=true"
                                class="inline-flex items-center justify-center h-10 text-sm font-medium transition-colors   focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none"><svg
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                </svg>
                            </button>
                        </div>
                    </span>







                    <div x-show="dropdownActionsOpen" @click.away="dropdownActionsOpen=false"
                        x-transition:enter="ease-out duration-200" x-transition:enter-start="-translate-y-2"
                        x-transition:enter-end="translate-y-0" class="absolute z-50 -right-10" x-cloak>
                        <div
                            class="p-1 mt-1 text-sm bg-white border rounded-md shadow-md border-neutral-200/70 text-neutral-700">
                            <button @click="updateFormMessage=true; dropdownActionsOpen=false;"
                                class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">

                                <span
                                    class="ml-auto text-xs tracking-widest text-neutral-400 group-hover:text-neutral-600">

                                    <i class="fa-regular fa-pen-to-square"></i>
                                </span>
                            </button>
                            <button wire:click='deleteMessage({{ $message->id }})'
                                class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">

                                <span
                                    class="ml-auto text-xs tracking-widest text-neutral-400 group-hover:text-neutral-600"><i
                                        class="fa-solid fa-trash"></i></span>
                            </button>

                        </div>
                    </div>



                </div>
            @else
                <div class="flex justify-start relative" x-data="{ dropdownActionsOpen: false, updateFormMessage: false }">




                    <span class="bg-red-200">

                        <div class="flex items-center">
                            @if ($message->path)
                                <div class="">
                                    <img class="object-cover" src="{{ asset('storage/' . $message->path) }}"
                                        alt="message image">
                                </div>
                            @endif
                            {{ $message->text }}

                        </div>






                    </span>





                </div>
            @endif

        @empty
            <span>
                No hay mensajes.
            </span>
        @endforelse

    </div>


    <div class="flex items-start space-x-4 h-16">

        <div class="min-w-0 flex-1">
            <div action="#" class="relative">
                <div
                    class="overflow-hidden rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600">
                    <label for="comment" class="sr-only">Write your message</label>
                    <textarea wire:model.live="messageInput" wire:keydown.shift.enter="sendMessage" rows="3" name="comment"
                        id="comment"
                        class="block w-full resize-none border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                        placeholder="Add your comment..."></textarea>

                </div>
 
                <div class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">
                    <div class="flex items-center space-x-5">
                        <div class="flex items-center">
                            <label for="path">
                                <div class="-m-2.5 flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500"
                                    for>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="sr-only">Attach a file</span>
                                </div>

                                @if ($image)
                                    <div class=" ">
                                        <img class="h-auto w-auto object-cover" src="{{ $image->temporaryUrl() }}">
                                    </div>
                                @endif


                            </label>
                        </div>
                        <input wire:model="image" type="file" id="path" hidden>

                    </div>
                    <div class="flex-shrink-0">
                        <button wire:click="sendMessage"
                            class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Send</button>
                    </div>
                </div> 
            </div>
        </div>
    </div>
@else
    <div class="flex justify-center">
        <h1 class="m-5 mt-12">
            Chat Room
        </h1>
    </div>


@endif

</div>

@script
    <script>
        let components = Livewire.all();

        //    console.log(components);

        $wire.on('showMessages', (e) => {

            console.log(e[0]);
            let chatID = e[0];
            //   console.log($wire.$get('chatId'));

            // console.log('Hola');
            // 
            Echo.channel(`chats.${chatID}`).listen(
                "Chat",
                (event) => {

                    console.log(event);

                    $wire.$dispatchSelf('RefreshMessages');

                })

        });
    </script>
@endscript
