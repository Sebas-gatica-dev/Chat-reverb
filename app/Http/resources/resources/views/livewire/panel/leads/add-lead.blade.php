<div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Agregar Lead</h1>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    <a wire:navigate href="{{ route('panel.leads.list') }}"
                        class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Volver</a>
                </div>
            </div>
        </div>
    </header>

    <main>


 

        <div class="mx-auto max-w-screen-2xl mt-8 py-6 sm:px-6 lg:px-8">

            <div x-data="{
                statuses: @js($statusesArray),
                currentStatus: @entangle('status').live
            }"
            class="
            max-sm:overflow-auto-x
            "
            >


            


                <ol class="flex justify-between text-gray-500 gap-x-10 md:gap-x-0 
                max-sm:overflow-x-auto 
                max-sm:overflow-y-hidden
                py-6">
                    <template x-for="(status, index) in statuses" :key="status.value">
                        <li class="relative flex-1 text-center" >
                            <!-- Icono -->
                            <span
                                :class="[
                                    'absolute left-1/2 transform -translate-x-1/2 -top-4 flex items-center justify-center w-8 h-8 rounded-full ring-4 ',
                                    currentStatus === status.value
                                        ? 'bg-green-500   ring-green-900'
                                        : 'bg-gray-700   ring-gray-900 '
                                ]"
                            >
                                <!-- Icono representativo del estado -->
                                <div x-html="status.icon" :class="currentStatus === status.value ? 'text-green-900' : 'text-gray-200'"></div>
                            </span>
                            <!-- Título del estado -->
                            <h3 class="font-medium text-sm leading-tight mt-7" 
                            :class="currentStatus === status.value ? 'text-green-900' : 'text-gray-500'"
                            
                            x-text="status.name"></h3>
                            <!-- Descripción del estado -->
                            <p class="text-xs hidden sm:block " 
                             :class="currentStatus === status.value ? 'text-green-900' : 'text-gray-500'"
                            x-text="status.description"></p>
                        </li>
                    </template>
                </ol>
            </div>
            

{{-- 
            <div x-data="{
                statuses: @js($statusesArray),
                currentStatus: @entangle('status').live
            }" class="flex space-x-3">
                <template x-for="status in statuses" :key="status.value">

                    <div :class="currentStatus === status.value ? 'bg-green-500 text-white' : 'bg-gray-50'"
                        class="flex-1 p-5 border rounded-md shadow-sm  border-neutral-200/70">
                        <span x-text="status.name" class="font-semibold"></span>
                    </div>
                </template>
            </div> --}}


            {{-- <div x-data="{
                radioGroupSelectedValue: null,
                radioGroupOptions: [{
                        title: 'En proceso',
                        description: 'A utility-first CSS framework for rapid UI development.',
                        value: 'tailwind'
                    },
                    {
                        title: 'Presupuestado',
                        description: 'A rugged and lightweight JavaScript framework.',
                        value: 'alpine'
                    },
                    {
                        title: 'Concretado',
                        description: 'The PHP Framework for Web Artisans.',
                        value: 'laravel'
                    }
                ]
            }" class="flex space-x-3">
                <template x-for="(option, index) in radioGroupOptions" :key="index">
                    <label @click="radioGroupSelectedValue=option.value"
                        class="flex-1 flex items-start p-5 space-x-3 bg-white border rounded-md shadow-sm hover:bg-gray-50 border-neutral-200/70 w-full cursor-pointer">
                        <input type="radio" name="radio-group" :value="option.value" 
                            class="text-gray-900 focus:ring-gray-700" />
                        <span class="flex-grow relative flex flex-col text-left space-y-1.5 leading-none">
                            <span x-text="option.title" class="font-semibold"></span>
                            <span x-text="option.description" class="text-sm opacity-50"></span> --}}
            {{-- </span>
            </label>
            </template>
        </div> --}}

            <div x-data="{
                currentStep: @entangle('currentStep').live, // Paso actual
                completedSteps: @entangle('completedSteps').live,
                blockedSteps: @entangle('blockedSteps').live,
            
            
                steps: [
                    { step: 1, name: 'Cliente' },
                    { step: 2, name: 'Propiedad' },
                    { step: 3, name: 'Teléfonos' },
                    { step: 4, name: 'Imágenes y videos' },
                    { step: 5, name: 'Visita de inspección' },
                    { step: 6, name: 'Presupuesto' },
                    { step: 7, name: 'Trabajo a realizar' },
            
                    // Agrega los pasos que necesites
                ],
            
                setStep(step) {
                    if (this.isBlocked(step)) {
                        console.log('No se puede avanzar, el paso está bloqueado');
                        return;
                    }
                    this.currentStep = step;
                },
            
                isCompleted(step) {
                    return this.completedSteps.includes(step); // Verifica si el paso está completado
                },
            
                isBlocked(step) {
                    return this.blockedSteps.includes(step);
                }
            }">
                <nav aria-label="Progress" class="flex justify-center mt-10 mb-16">
                    <div class="max-lg:overflow-x-auto max-lg:w-full
                    "> 
                    <ol role="list" class="ml-2 md:ml-0 flex items-center py-10 lg:py-0">
                        <!-- Iteramos sobre los pasos usando x-for -->
                        <template x-for="step in steps" :key="step.step">
                            <li :class="step.step != steps.length ? 'relative pr-40' : 'relative'">
                                <!-- Mostrar la línea solo si es el último paso -->
                                <template x-if="step.step != steps.length">
                                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                        <div :class="isCompleted(step.step) && step.step < Math.max(...completedSteps) ?
                                            'bg-black' :
                                            (step.step >= Math.max(...completedSteps) && step.step < currentStep ?
                                                'bg-gray-400' :
                                                'bg-gray-200')"
                                            class="h-0.5 w-full" x-show="step.step !== steps.length">
                                        </div>




                                </template>
                                <a href="#" @click="setStep(step.step)"
                                    class="relative flex flex-col items-center"
                                    :class="isBlocked(step.step) ? 'cursor-not-allowed' : ''">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full"
                                        :class="currentStep === step.step ? 'bg-black text-white' : (isCompleted(step.step) ?
                                            'bg-black text-white' : 'border-2 border-gray-300 bg-white')">

                                        <template x-if="currentStep === step.step">
                                            <!-- Mostrar círculo lleno para el paso seleccionado -->
                                            <span class="h-2.5 w-2.5 bg-white border-black rounded-full"></span>
                                        </template>

                                        <template x-if="currentStep !== step.step && isCompleted(step.step)">
                                            <!-- Mostrar check para pasos completados -->
                                            <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor"
                                                aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </template>

                                        <template x-if="currentStep !== step.step && !isCompleted(step.step)">
                                            <!-- Mostrar círculo vacío para pasos no completados ni seleccionados -->
                                            <span class="h-2.5 w-2.5 bg-gray-800 rounded-full"></span>
                                        </template>
                                    </div>
                                    <!-- Mostrar el nombre del paso debajo del círculo -->
                                    <span class="absolute w-max mt-10 text-sm font-medium text-gray-400"
                                        x-text="step.name"></span>
                                </a>
                            </li>
                        </template>
                    </ol>

                    </div>
                </nav>



                <!-- Contenido dinámico según el paso seleccionado -->
                <div class="mt-8 max-w-screen-lg mx-auto">
                    <div x-show="currentStep === 1" x-cloak>
                        <livewire:panel.leads.form.customer-form-lead :data="$formsData['customer']" lazy />
                    </div>

                    @if ($lead)
                        <div x-show="currentStep === 2" x-cloak>
                            <livewire:panel.leads.form.property-form-lead :data="$formsData['property']" />
                        </div>

                        <div x-show="currentStep === 3" x-cloak>
                            <livewire:panel.leads.form.phones-form-lead :data="$formsData['phones']" lazy />
                        </div>

                        <div x-show="currentStep === 4" x-cloak>
                            <livewire:panel.property.files.list-files :property="$formsData['files']"
                            :sourceLead="true"
                            />
                        </div>

                        <div x-show="currentStep === 5" x-cloak>
                            <livewire:panel.leads.form.visit-inspect-form-lead :visit="$lead->firstProperty->visitInspect" :property="$formsData['property']" />
                        </div>

                        <div x-show="currentStep === 6" x-cloak>
                            <livewire:panel.leads.form.budget-form-lead :data="$formsData['budget']" :lead="$lead" lazy />
                        </div>
                        <div x-show="currentStep === 7" x-cloak>
                            <livewire:panel.leads.form.visit-closed-form-lead :property="$formsData['property']" />
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</div>
