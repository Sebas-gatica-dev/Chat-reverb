  <div class="relative">

      <div class="grid grid-cols-3 gap h-96 absolute top-6">

          <div class="flex flex-col px-4 col-span-1">

              <div class="w-full h-16 shadow-lg border-b ">

                  <div
                      class="flex justify-between text-sm h-20 p-2 font-medium transition-colors bg-white border rounded-md text-neutral-700 focus:outline-none disabled:opacity-50 disabled:pointer-events-none">


                      <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gray-500 p-3">

                          <span
                              class="font-medium leading-none text-white p-3">{{ $this->avatarInitials($user->id) }}</span>

                      </span>



                      <span class="mt-2 ms-[32rem] mb-1">




                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                              stroke="currentColor" class="size-6">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                          </svg>


                      </span>

                  </div>




              </div>

              <div class="h-[calc(100vh-11rem)] overflow-y-auto">

                  @foreach ($users as $user)
                      <span wire:click='openChat({{ $user->id }})'
                          class="flex text-sm p-2 font-medium transition-colors bg-white border rounded-md text-neutral-700 hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none disabled:opacity-50 disabled:pointer-events-none">
                          {{-- <img src="https://cdn.devdojo.com/images/may2023/adam.jpeg" class="object-cover w-8 h-8 border rounded-full border-neutral-200" /> --}}


                          <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gray-500 p-3">

                              <span
                                  class="font-medium leading-none text-white">{{ $this->avatarInitials($user->id) }}</span>
                          </span>

                          <div>
                              <span class="flex flex-col items-start flex-shrink-0  ml-2 leading-none translate-y-px">
                                  <div>
                                      <span>{{ $user->name }}</span>
                                      <span class="text-xs font-light text-neutral-400">{{ $user->email }}</span>


                                  </div>
                                  <span class="text-xs font-light text-neutral-400 mt-2 ms-2 mb-1">
                                      @if ($this->hasMessages($user->id))
                                          {{ $this->getUserData($user->id)['text_last_mjs'] }}
                                      @endif
                                  </span>
                              </span>


                          </div>

                          <span
                              class="flex ms-72 items-center flex-shrink-0   leading-none translate-y-px  text-neutral-400">
                              @if ($this->hasMessages($user->id))
                                  {{ $this->getUserData($user->id)['time_last_mjs'] }}
                              @endif
                          </span>
                      </span>
                  @endforeach

              </div>


          </div>
          <div class="flex flex-col-reverse shadow-lg border-b col-span-2 ">
              <livewire:chat-component />
          </div>
      </div>
  </div>
  {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
