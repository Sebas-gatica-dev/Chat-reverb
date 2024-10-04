<div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Planes de suscripción</h1>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    <a wire:navigate href="{{ route('panel.customers.list') }}"
                        class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Volver</a>

                    {{-- <button type="button" class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Agregar cliente</button> --}}
                </div>
            </div>
        </div>


    </header>

    <main>
    <!-- Pricing section -->
    <div class="mx-auto mt-16 max-w-7xl px-6 sm:mt-32 lg:px-8">
        <div class="mx-auto max-w-4xl text-center">
          <h1 class="text-base font-semibold leading-7 text-indigo-600">Planes</h1>
          <p class="mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Precios de los planes mensuales</p>
        </div>
        <p class="mx-auto mt-6 max-w-2xl text-center text-lg leading-8 text-gray-600">Elegir el plan que mejor se adapte a tus necesidades. Todos los planes incluyen una prueba gratuita de 60 días (después del primer pago).</p>
        <div class="mt-16 flex justify-center">
          <fieldset aria-label="Payment frequency">
            <div class="grid grid-cols-2 gap-x-1 rounded-full p-1 text-center text-xs font-semibold leading-5 ring-1 ring-inset ring-gray-200">
              <!-- Checked: "bg-indigo-600 text-white", Not Checked: "text-gray-500" -->
              <label class="cursor-pointer rounded-full px-2.5 py-1">
                <input type="radio" name="frequency" value="monthly" class="sr-only">
                <span>Mensual</span>
              </label>
              <!-- Checked: "bg-indigo-600 text-white", Not Checked: "text-gray-500" -->
              <label class="cursor-pointer rounded-full px-2.5 py-1">
                <input type="radio" name="frequency" value="annually" class="sr-only">
                <span>Anual</span>
              </label>
            </div>
          </fieldset>
        </div>
        <div class="isolate mx-auto mt-10 grid max-w-md grid-cols-1 gap-8 md:max-w-2xl md:grid-cols-3 lg:max-w-4xl xl:mx-0 xl:max-w-none xl:grid-cols-3">

            @foreach ($plans as $plan)
            <div class="rounded-3xl p-8 {{ $plan->is_featured ? 'ring-2 ring-indigo-600' : 'ring-1 ring-gray-200' }}">

                <h2 id="tier-hobby" class="text-lg font-semibold leading-8 {{ $plan->is_featured ? 'text-indigo-600' : 'text-gray-900' }}">{{ $plan->name }}</h2>

                <p class="mt-4 text-sm leading-6 text-gray-600">{{ $plan->description }}</p>

                <p class="mt-6 flex items-baseline gap-x-1">
                  <!-- Price, update based on frequency toggle state -->
                  <span class="text-4xl font-bold tracking-tight text-gray-900">${{ $plan->price }}</span>
                  <!-- Payment frequency, update based on frequency toggle state -->
                  <span class="text-sm font-semibold leading-6 text-gray-600">/mes</span>
                </p>

                <span wire:click="selectPlan('{{ $plan->id }}')" aria-describedby="tier-hobby" class="mt-6 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 text-indigo-600 ring-1 ring-inset ring-indigo-200 hover:ring-indigo-300 cursor-pointer">Elegir plan</span>
                <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-600">
                  <li class="flex gap-x-3">
                    <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                    </svg>
                    2 usuarios
                  </li>
                  <li class="flex gap-x-3">
                    <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                    </svg>
                    hasta 2000 clientes
                  </li>
                  <li class="flex gap-x-3">
                    <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                    </svg>
                    1 sucursal
                  </li>
                </ul>
              </div>
            @endforeach

          {{-- <div class="rounded-3xl p-8 ring-1 ring-gray-200">
            <h2 id="tier-hobby" class="text-lg font-semibold leading-8 text-gray-900">Unipersonal</h2>
            <p class="mt-4 text-sm leading-6 text-gray-600">Es el plan ideal para unipersonales y emprendedores.</p>
            <p class="mt-6 flex items-baseline gap-x-1">
              <!-- Price, update based on frequency toggle state -->
              <span class="text-4xl font-bold tracking-tight text-gray-900">$35.000</span>
              <!-- Payment frequency, update based on frequency toggle state -->
              <span class="text-sm font-semibold leading-6 text-gray-600">/mes</span>
            </p>
            <a href="#" aria-describedby="tier-hobby" class="mt-6 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 text-indigo-600 ring-1 ring-inset ring-indigo-200 hover:ring-indigo-300">Elegir plan</a>
            <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-600">
              <li class="flex gap-x-3">
                <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                </svg>
                2 usuarios
              </li>
              <li class="flex gap-x-3">
                <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                </svg>
                hasta 2000 clientes
              </li>
              <li class="flex gap-x-3">
                <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                </svg>
                1 sucursal
              </li>
            </ul>
          </div>
          <div class="rounded-3xl p-8 ring-1 ring-gray-200">
            <h2 id="tier-freelancer" class="text-lg font-semibold leading-8 text-gray-900">Pequeña empresa</h2>
            <p class="mt-4 text-sm leading-6 text-gray-600">Ideal para pequeñas empresas y en pleno crecimiento.</p>
            <p class="mt-6 flex items-baseline gap-x-1">
              <!-- Price, update based on frequency toggle state -->
              <span class="text-4xl font-bold tracking-tight text-gray-900">$78.900</span>
              <!-- Payment frequency, update based on frequency toggle state -->
              <span class="text-sm font-semibold leading-6 text-gray-600">/mes</span>
            </p>
            <a href="#" aria-describedby="tier-freelancer" class="mt-6 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 text-indigo-600 ring-1 ring-inset ring-indigo-200 hover:ring-indigo-300">Elegir plan</a>
            <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-600">
              <li class="flex gap-x-3">
                <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                </svg>
                10 usuarios
              </li>
              <li class="flex gap-x-3">
                <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                </svg>
                hasta 7500 clientes
              </li>
              <li class="flex gap-x-3">
                <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                </svg>
                3 sucursales
              </li>
              <li class="flex gap-x-3">
                <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                </svg>
                Facturación electrónica
              </li>
            </ul>
          </div> --}}
          {{-- <div class="rounded-3xl p-8 ring-2 ">
            <h2 id="tier-startup" class="text-lg font-semibold leading-8 text-indigo-600">Sin techo</h2>
            <p class="mt-4 text-sm leading-6 text-gray-600">Para empresas que buscan crecer sin límites.</p>
            <p class="mt-6 flex items-baseline gap-x-1">
              <!-- Price, update based on frequency toggle state -->
              <span class="text-4xl font-bold tracking-tight text-gray-900">195.800</span>
              <!-- Payment frequency, update based on frequency toggle state -->
              <span class="text-sm font-semibold leading-6 text-gray-600">/mes</span>
            </p>
            <a href="#" aria-describedby="tier-startup" class="mt-6 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 bg-indigo-600 text-white shadow-sm hover:bg-indigo-500">Elegir plan</a>
            <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-600">
              <li class="flex gap-x-3">
                <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                </svg>
                Usuarios ilimitados
              </li>
              <li class="flex gap-x-3">
                <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                </svg>
                Clientes ilimitados
              </li>
              <li class="flex gap-x-3">
                <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                </svg>
                Sucursales ilimitadas
              </li>
              <li class="flex gap-x-3">
                <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                </svg>
                Facturación electrónica
              </li>
              <li class="flex gap-x-3">
                <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                </svg>
                Chat centralizado (WhatsApp, Messenger, Instagram)
              </li>
            </ul>
          </div> --}}

        </div>
      </div>

      <!-- Logo cloud -->
      <div class="mx-auto mt-24 max-w-7xl px-6 sm:mt-32 lg:px-8">
        <div class="mx-auto grid max-w-lg grid-cols-4 items-center gap-x-8 gap-y-12 sm:max-w-xl sm:grid-cols-6 sm:gap-x-10 sm:gap-y-14 lg:mx-0 lg:max-w-none lg:grid-cols-5">
          <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1" src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4d/OpenAI_Logo.svg/512px-OpenAI_Logo.svg.png" alt="Transistor" width="158" height="48">
          <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1" src="https://upload.wikimedia.org/wikipedia/commons/7/7b/Meta_Platforms_Inc._logo.svg" alt="Reform" width="158" height="48">
          <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1" src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/82/Telegram_logo.svg/512px-Telegram_logo.svg.png?20220101141644" alt="Tuple" width="158" height="48">
          <img class="col-span-2 max-h-12 w-full object-contain sm:col-start-2 lg:col-span-1" src="https://iconape.com/wp-content/png_logo_vector/afip-logo.png" alt="SavvyCal" width="158" height="48">
          <img class="col-span-2 col-start-2 max-h-12 w-full object-contain sm:col-start-auto lg:col-span-1" src="https://zeevector.com/wp-content/uploads/Google-Ads-Logo-PNG.png" alt="Statamic" width="158" height="48">
        </div>
        <div class="mt-16 flex justify-center">
          <p class="relative rounded-full bg-gray-50 px-4 py-1.5 text-sm leading-6 text-gray-600 ring-1 ring-inset ring-gray-900/5">
            <span class="hidden md:inline">Transistor saves up to $40,000 per year, per employee by working with us.</span>
            <a href="#" class="font-semibold text-indigo-600"><span class="absolute inset-0" aria-hidden="true"></span> See our case study <span aria-hidden="true">&rarr;</span></a>
          </p>
        </div>
      </div>

    </main>


</div>
