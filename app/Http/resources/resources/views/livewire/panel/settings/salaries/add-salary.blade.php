<div>
    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">{{ $salary ? 'Editar salario' : 'Agregar salario' }}</h1>
        <aside
            class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">
            @include('components.panel.settings.menu-side-bar-settings')
        </aside>
        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:pt-20">
            <div class="mx-auto max-w-2xl space-y-4 sm:space-y-4 lg:mx-0 lg:max-w-none">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">
                            {{ $salary ? 'Editar salario' : 'Agregar salario' }}</h1>
                        <p class="mt-2 text-sm text-gray-700">Vas a poder {{ $salary ? 'editar' : 'agregar' }}
                            detalladamente la ganancia del mes del
                            trabajador.</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a wire:navigate href="{{ route('panel.settings.salaries.list') }}"
                            class="cursor-pointer block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Atras
                        </a>
                    </div>
                </div>
                <div class="mt-8 flow-root">
                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
                        <div class="px-4 py-6 sm:p-8">
                            <div class="grid w-full grid-cols-1 gap-x-6 gap-y-6 md:gap-y-8 sm:grid-cols-12">
                                <div class="col-span-3">
                                    <label for="users"
                                        class="block text-sm font-medium leading-6 text-gray-900">Usuario</label>
                                    <div class="mt-2">
                                        <livewire:components.select-general :selectedValue="$form->selectedUser" :values="$form->users"
                                            :imageValue="false" :searchEnabled="false" :name="'users'" :model="false">

                                    </div>
                                    @error('form.selectedUser')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-span-3">
                                    <label for="typesSalary"
                                        class="block text-sm font-medium leading-6 text-gray-900">Tipo de
                                        ganancia</label>
                                    <div class="mt-2">
                                        <livewire:components.select-general :selectedValue="$form->selectedTypeSalary" :values="$form->typesSalary"
                                            :imageValue="false" :searchEnabled="false" :name="'typesSalary'" :model="false">

                                    </div>
                                    @error('form.selectedTypeSalary')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                @if ($form->selectedTypeSalary == App\Enums\Salaries\TypeSalaryEnum::PERCENTAGE->value)
                                    <div class="col-span-full sm:col-span-3">
                                        <label for="salary_mount"
                                            class="block text-sm font-medium leading-6 text-gray-900">Solo porcentaje de
                                            la ganancia?</label>
                                        <div class="mt-3.5">
                                            <livewire:components.toggle :breakdown="false" :dark="false"
                                                :disabled="$form->onlyProfit != null" :name="'only-profit'" />
                                        </div>
                                    </div>
                                @endif


                                @if (
                                    $form->selectedTypeSalary == App\Enums\Salaries\TypeSalaryEnum::COMMISSIONS->value ||
                                        $form->selectedTypeSalary == App\Enums\Salaries\TypeSalaryEnum::PERCENTAGE->value ||
                                        $form->selectedTypeSalary == App\Enums\Salaries\TypeSalaryEnum::HOURLY->value)
                                    <div class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-3 ">
                                        <label for="typesSalaryValue"
                                            class="block text-sm font-medium leading-6 text-gray-900">{{ $form->selectedTypeSalary == App\Enums\Salaries\TypeSalaryEnum::COMMISSIONS->value ? 'Ganancia por comisión' : ($form->selectedTypeSalary == App\Enums\Salaries\TypeSalaryEnum::PERCENTAGE->value ? '¿Que porcentaje recibirá?' : '¿Cuanto recibirá por hora?') }}</label>
                                        <div class="mt-2">

                                            @if($form->selectedTypeSalary == 'percentage')
                                            <input type="text" wire:model="form.typesSalaryValue" id="form.typesSalaryValue"
                                                autocomplete="off" placeholder="Escriba un nombre para la plantilla"
                                                x-mask:dynamic="$money($input, ',')" x-ref="typesSalaryValue"
                                                placeholder="0,00"
                                                x-on:input="
                                                    let cleanedValue = $refs.typesSalaryValue.value.replace(/\./g, '').replace(',', '.'); // Limpiamos separadores y convertimos a decimal
                                                    let decimalValue = parseFloat(cleanedValue); // Convertimos a número decimal para validación
                                                    
                                                    // Limitamos el valor a un rango entre 1 y 100
                                                    if (decimalValue < 1) {
                                                        $refs.typesSalaryValue.value = '1,00';
                                                    } else if (decimalValue >= 100) {
                                                     console.log('mayor a 100')
                                                        $refs.typesSalaryValue.value = '100';
                                                    } 

                                                    console.log($refs.typesSalaryValue.value);
                                                    
                                                    // Refrescamos el input para que se aplique la máscara correctamente
                                                    $refs.typesSalaryValue.blur(); 
                                                    $refs.typesSalaryValue.focus();
                                                "
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                                @else

                                                <input type="text" wire:model="form.typesSalaryValue"
                                                id="form.typesSalaryValue" autocomplete="off"
                                                x-mask:dynamic="$money($input, ',')" x-ref="typesSalaryValue"
                                                x-on:keyup="$refs.typesSalaryValue.blur(); $refs.typesSalaryValue.focus()"
                                                placeholder="Escriba un nombre para la plantilla"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        
                                                @endif
                                             </div>
                                        @error('form.typesSalaryValue')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif


                                @if (
                                    $form->selectedTypeSalary == App\Enums\Salaries\TypeSalaryEnum::COMMISSIONS->value ||
                                        $form->selectedTypeSalary == App\Enums\Salaries\TypeSalaryEnum::PERCENTAGE->value)
                                    <div class="col-span-3">
                                        <label for="profitsOfSalary"
                                            class="block text-sm font-medium leading-6 text-gray-900">Ganancia de
                                            los</label>
                                        <div class="mt-2">
                                            <livewire:components.select-general :selectedValue="$form->selectedProfitSalary" :values="$form->profitsOfSalary"
                                                :imageValue="false" :searchEnabled="false" :name="'profitsOfSalary'"
                                                :model="false">

                                        </div>
                                        @error('form.selectedProfitSalary')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-span-3">
                                        <label for="modallyProfitsSalary"
                                            class="block text-sm font-medium leading-6 text-gray-900">De que
                                            {{ $form->selectedProfitSalary ? Str::lower(App\Enums\Salaries\ProfitOfSalaryEnum::from($form->selectedProfitSalary)->getName()) : '' }}?</label>
                                        <div class="mt-2">
                                            <livewire:components.select-general :selectedValue="$form->selectedModallyProfitSalary" :values="$form->modallyProfitsSalary"
                                                :imageValue="false" :searchEnabled="false" :name="'modallyProfitsSalary'"
                                                :model="false">

                                        </div>
                                        @error('form.selectedModallyProfitSalary')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    @if (
                                        $form->selectedModallyProfitSalary == App\Enums\Salaries\ModallyProfitSalaryEnum::USERS->value ||
                                            $form->selectedModallyProfitSalary == App\Enums\Salaries\ModallyProfitSalaryEnum::BRANCHES->value)
                                        <div class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-3 ">
                                            <livewire:components.multi-select-general :selectedValues="$form->selectedmodallyIds"
                                                :values="$form->modallyIds" :imageValue="false" :defaultOption="'Elegí usuarios o '"
                                                :searchEnabled="true" :name="'modallyIds'" :model="false"
                                                label="Usuarios o Sucursales" />

                                            @error('form.selectedmodallyIds')
                                                <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endif

                                    @if ($form->selectedProfitSalary == 'customers')
                                        <div class="col-span-3">
                                            <label for="modallyProfitsCountSalary"
                                                class="block text-sm font-medium leading-6 text-gray-900">¿Cúantas veces
                                                querés que comisione?</label>
                                            <div class="mt-2">
                                                <livewire:components.select-general :selectedValue="$form->selectedModallyProfitCountSalary"
                                                    :values="$form->modallyProfitsCountSalary" :imageValue="false" :searchEnabled="false"
                                                    :name="'modallyProfitsCountSalary'" :model="false">

                                            </div>
                                            @error('form.selectedModallyProfitCountSalary')
                                                <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        @if ($form->selectedModallyProfitCountSalary == 'days' || $form->selectedModallyProfitCountSalary == 'count')
                                            <div class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-3 ">
                                                <label for="modally_profit_quantity"
                                                    class="block text-sm font-medium leading-6 text-gray-900">{{ $form->selectedModallyProfitCountSalary == 'days' ? 'Días que queres mantener la posibilidad de comisionar' : 'Cuantas veces puede comisionar?' }}</label>
                                                <div class="mt-2">
                                                    <input type="number" wire:model="form.modally_profit_quantity"
                                                        id="form.modally_profit_quantity" autocomplete="off"
                                                        placeholder="Escriba un nombre para la plantilla"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                                </div>
                                                @error('form.modally_profit_quantity')
                                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif

                                    @endif
                                @endif



                                @if (
                                    $form->selectedTypeSalary == App\Enums\Salaries\TypeSalaryEnum::SALARY_FIXED->value ||
                                        $form->selectedTypeSalary == App\Enums\Salaries\TypeSalaryEnum::COMMISSIONS->value ||
                                        $form->selectedTypeSalary == App\Enums\Salaries\TypeSalaryEnum::PERCENTAGE->value)
                                    <div class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-3 ">
                                        <label for="salary_mount"
                                            class="block text-sm font-medium leading-6 text-gray-900">{{ $form->selectedTypeSalary == App\Enums\Salaries\TypeSalaryEnum::SALARY_FIXED->value ? 'Salario mensual' : '¿Querés sumarle un sueldo básico?' }}</label>
                                        <div class="mt-2">
                                            <input type="text" wire:model="form.salary_mount" id="form.salary_mount"
                                                x-mask:dynamic="$money($input, ',')" x-ref="salary_mount"
                                                x-on:keyup="$refs.salary_mount.blur(); $refs.salary_mount.focus()"
                                                autocomplete="off" placeholder="Escriba un nombre para la plantilla"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        </div>
                                        @error('form.salary_mount')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif


                                <div class="col-span-3">
                                    <label for="taxesSalary"
                                        class="block text-sm font-medium leading-6 text-gray-900">¿Algún
                                        impuesto?</label>
                                    <div class="mt-2">
                                        <livewire:components.select-general :selectedValue="$form->selectedTaxSalary" :values="$form->taxesSalary"
                                            :imageValue="false" :searchEnabled="false" :name="'taxesSalary'" :model="false">

                                    </div>
                                    @error('form.selectedTaxSalary')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>


                                @if ($form->selectedTaxSalary == 'fixed' || $form->selectedTaxSalary == 'percentage')
                                    <div class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-3 ">
                                        <label for="salary_mount"
                                            class="block text-sm font-medium leading-6 text-gray-900">Cuanto
                                            impuesto?</label>
                                        <div class="mt-2">
                                            @if($form->selectedTaxSalary == 'percentage')
                                            <input type="text" wire:model="form.taxesValue" id="form.salary_mount"
                                                autocomplete="off" placeholder="Escriba un nombre para la plantilla"
                                                x-mask:dynamic="$money($input, ',')" x-ref="taxesValue"
                                                placeholder="0,00"
                                                x-on:input="
                                                    let cleanedValue = $refs.taxesValue.value.replace(/\./g, '').replace(',', '.'); // Limpiamos separadores y convertimos a decimal
                                                    let decimalValue = parseFloat(cleanedValue); // Convertimos a número decimal para validación
                                                    
                                                    // Limitamos el valor a un rango entre 1 y 100
                                                    if (decimalValue < 1) {
                                                        $refs.taxesValue.value = '1,00';
                                                    } else if (decimalValue >= 100) {
                                                     console.log('mayor a 100')
                                                        $refs.taxesValue.value = '100';
                                                    } 

                                                    console.log($refs.taxesValue.value);
                                                    
                                                    // Refrescamos el input para que se aplique la máscara correctamente
                                                    $refs.taxesValue.blur(); 
                                                    $refs.taxesValue.focus();
                                                "
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                                @else

                                                <input type="text" wire:model="form.taxesValue"
                                                id="form.taxesValue" autocomplete="off"
                                                x-mask:dynamic="$money($input, ',')" x-ref="taxesValue"
                                                x-on:keyup="$refs.taxesValue.blur(); $refs.taxesValue.focus()"
                                                placeholder="Escriba un nombre para la plantilla"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        
                                                @endif
                                        </div>
                                        @error('form.taxesValue')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif

                                <div class="col-span-3">
                                    <label for="transportsSalary"
                                        class="block text-sm font-medium leading-6 text-gray-900">¿Sumamos
                                        transporte?</label>
                                    <div class="mt-2">
                                        <livewire:components.select-general :selectedValue="$form->selectedTransportSalary" :values="$form->transportsSalary"
                                            :imageValue="false" :searchEnabled="false" :name="'transportsSalary'" :model="false">

                                    </div>
                                    @error('form.selectedTransportSalary')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>


                                @if ($form->selectedTransportSalary == 'fixed' || $form->selectedTransportSalary == 'kilometer')
                                    <div class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-3 ">
                                        <label for="salary_mount"
                                            class="block text-sm font-medium leading-6 text-gray-900">Cuanto por
                                            transporte?</label>
                                        <div class="mt-2">
                                            <input type="text" wire:model="form.transportsValue"
                                                id="form.transportsValue" autocomplete="off"
                                                x-mask:dynamic="$money($input, ',')" x-ref="transportsValue"
                                                x-on:keyup="$refs.transportsValue.blur(); $refs.transportsValue.focus()"
                                                placeholder="Escriba un nombre para la plantilla"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        </div>
                                        @error('form.transportsValue')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif








                            </div>



                        </div>

                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach

                        <div class="flex items-center justify-end pr-7 pb-6">

                            @if ($salary)
                                <button wire:click="update"
                                    class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Editar
                                    salario</button>
                            @else
                                <button wire:click="save"
                                    class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Agregar
                                    salario</button>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
