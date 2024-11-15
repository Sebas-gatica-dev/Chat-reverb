<div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Lista de propiedades de {{ $customer->name }}</h1>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">

                  <a wire:navigate href="{{ route('panel.customers.list', $customer->id) }}" class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Volver</a>
                </div>
              </div>
        </div>


    </header>
    <main>
        <div class="mx-auto max-w-screen-2xl py-6 sm:px-6 lg:px-8">
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">

                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                                @foreach ($customer->properties as $property)


                                <li class="col-span-1 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow">
                                  <div class="flex flex-1 flex-col p-8">
                                    <a href="{{ route('panel.customers.property.show', [$customer->id, $property->id]) }}" wire:navigate class="flex-1">
                                      <h3 class="text-sm font-bold text-gray-900 mb-2">{{ $property->property_name }}</h3>

                                    <img class="mx-auto h-32 w-32 flex-shrink-0 rounded-full" src="{{ $property->photo }}" alt="{{ $property->property_name }}">
                                    </a>
                                    <h3 class="mt-6 text-sm font-medium text-gray-900">{{ $property->address }}</h3>
                                    <dl class="mt-1 flex flex-grow flex-col justify-between">

                                      <dd class="text-sm text-gray-500">{{ $property->city->name }}, {{ $property->neighborhood->name }}</dd>

                                      <dd class="mt-3">
                                        <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{ \App\Enums\FrequencyEnum::getFrequency($property->frequency) }}</span>
                                      </dd>
                                    </dl>
                                  </div>
                                  <div>

                                    <div class="-mt-px flex divide-x divide-gray-200">
                                      <div class="flex w-0 flex-1">
                                        <a href="mailto:{{ $customer->email }}" class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                          <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                                            <path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                                          </svg>
                                          Email
                                        </a>
                                      </div>
                                      <div class="-ml-px flex w-0 flex-1">
                                        <a href="https://maps.google.com/?q={{ $property->latitude }},{{ $property->longitude }}" target="_blank" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900"">

                                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5 text-red-400">
                                            <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
                                          </svg>

                                          Ubicación
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                                @endforeach
                                <!-- More people... -->
                              </ul>


                    </div>



                </div>
            </div>
        </div>
    </main>

</div>
