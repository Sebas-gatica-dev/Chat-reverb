<div class="mx-auto max-w-screen-2xl md:px-6 lg:px-8 my-4">


    <fieldset>
        <legend class="block font-medium">Fecha</legend>
        <div class="space-y-4 pt-2">
            <livewire:components.date-picker :rangeOptions="[
                'Último mes',
                'Hoy',
                'Anteriores 7 días',
                'Anteriores 15 días',
                'Anteriores 30 días',
                'Mes actual',
                'Año actual',
            ]" />
        </div>
    </fieldset>


    @if ($template)
        <livewire:panel.stats.preview-stats :template="$template" :pickerStartDate="$pickerStartDate" :pickerEndDate="$pickerEndDate" :pickerRange="$pickerRange"
            :live="true" lazy />
    @else
        <div class="text-center mt-6 min-w-full   md:rounded-b-md md:shadow">
            <div class=" rounded-md">
                <div class="rounded-md bg-yellow-50 p-4 border border-yellow-600 shadow-sm">
                    <div class="text-sm font-medium text-yellow-700 text-center ">
                        <p>Todavía no te han asignado ninguna plantilla para que puedas ver estadísticas</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
