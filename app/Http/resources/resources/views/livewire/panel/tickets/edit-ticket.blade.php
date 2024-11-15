<div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Editar Ticket</h1>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    <a wire:navigate href="{{ route('panel.tickets.list') }}"
                        class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main x-data="{ type: @entangle('type').live }">
        <div class="mx-auto max-w-screen-2xl py-6 sm:px-6 lg:px-8">
            <div class="mt-8 flow-root">
                <div class="space-y-10 divide-y divide-gray-900/10">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-4">
                        <div class="px-4 sm:px-0">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Información del Ticket</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">
                                Complete los detalles del ticket.
                            </p>
                        </div>

                        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
                            <div class="px-4 py-6 sm:p-8">
                                <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-9">
                                    <!-- Tipo de Ticket -->
                                    <div class="sm:col-span-3">
                                        <label for="type" class="block text-sm font-medium leading-6 text-gray-900">
                                            Tipo de Ticket
                                        </label>
                                        <div class="mt-2">


                                            <livewire:components.select-general :selectedValue="$type" :values="$types"
                                                :imageValue="false" :searchEnabled="false" :name="'type'" :model="false">
                                        </div>
                                        @error('type')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Fecha -->
                                    <div class="sm:col-span-3">
                                        <label for="date" class="block text-sm font-medium leading-6 text-gray-900">
                                            Fecha
                                        </label>
                                        <div class="mt-2">
                                            <input type="date" wire:model.live="date" id="date" autocomplete="off"
                                                placeholder="dd/mm/yyyy"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                                ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2
                                                focus:ring-inset focus:ring-indigo-600 text-sm  sm:leading-6">
                                        </div>
                                        @error('date')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Usuario -->
                                    <div class="sm:col-span-3">
                                        <label for="user_id" class="block text-sm font-medium leading-6 text-gray-900">
                                            Usuario
                                        </label>
                                        <div class="mt-2">


                                            <livewire:components.select-general :selectedValue="$user_id" :values="$users"
                                                :imageValue="false" :searchEnabled="true" :name="'user'"
                                                :model="false">

                                        </div>
                                        @error('user_id')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Monto -->
                                    <div class="sm:col-span-3">
                                        <label for="amount" class="block text-sm font-medium leading-6 text-gray-900">
                                            Monto
                                        </label>
                                        <div class="mt-2">
                                            <input type="number" wire:model.live="amount" id="amount" autocomplete="off"
                                                placeholder="0.00" step="0.01"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                                ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2
                                                focus:ring-inset focus:ring-indigo-600 text-sm  sm:leading-6">
                                        </div>
                                        @error('amount')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    
                                    <!-- Descuento -->
                                    <div class="sm:col-span-3">
                                        <label for="amount" class="block text-sm font-medium leading-6 text-gray-900">
                                            Descontar de la billetera
                                        </label>
                                        <div class="mt-3">
                                            
                                            <livewire:components.toggle 
                                      
                                            :checked="$discount_bill"
                                            />

                                        </div>
                                        @error('amount')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <!-- Detalle -->
                                    <div class="sm:col-span-9">
                                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">
                                            Detalle
                                        </label>
                                        <div class="mt-2">
                                            <textarea id="description" wire:model.live="description" rows="3"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                                ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2
                                                focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                        </div>
                                        @error('description')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Comprobante -->
                                    <div class="sm:col-span-3"
                                        x-show="type == '{{ App\Enums\Tickets\TypeTicketEnum::EXPENSES }}' || type == '{{ App\Enums\Tickets\TypeTicketEnum::ADJUSTMENT }}' || type == '{{ App\Enums\Tickets\TypeTicketEnum::TRANSFER_DEPOSIT }}'">
                                        <label for="proof" class="block text-sm font-medium leading-6 text-gray-900">
                                            Comprobante
                                        </label>
                                        
                                        <livewire:components.upload-file 
                                        :multiple="false" 
                                        :types="['image']" 
                                         :existingFiles="$proof"
                                        :name="'proof'" 
                                        
                                        />

                                    </div>

                                    <!-- Sucursal -->
                                    <div class="sm:col-span-3"
                                        x-show="type == '{{ \App\Enums\Tickets\TypeTicketEnum::CASH_DEPOSIT }}'">
                                        <label for="branch_id"
                                            class="block text-sm font-medium leading-6 text-gray-900">
                                            Sucursal
                                        </label>
                                        <div class="mt-2">


                                            <livewire:components.select-general :selectedValue="$branch_id" :values="$branches"
                                                :imageValue="false" :searchEnabled="false" :name="'branch'" :model="false">
                                        </div>
                                        @error('branch_id')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Cuenta Bancaria -->
                                    <div class="sm:col-span-3"
                                        x-show="type == '{{ \App\Enums\Tickets\TypeTicketEnum::TRANSFER_DEPOSIT}}'">
                                        <label for="bank_account_id"
                                            class="block text-sm font-medium leading-6 text-gray-900">
                                            Cuenta Bancaria
                                        </label>
                                        <div class="mt-2">


                                            <livewire:components.select-general :selectedValue="$bank_account_id"
                                                :values="$bank_accounts" :imageValue="false" :searchEnabled="false"
                                                :name="'bank_account'" :model="false">


                                        </div>
                                        @error('bank_account_id')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div
                                class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                                <button wire:click="update"
                                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm
                                    hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2
                                    focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    Actualizar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>
