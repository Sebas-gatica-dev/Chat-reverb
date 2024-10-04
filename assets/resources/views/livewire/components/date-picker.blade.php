<div>
    <div x-data="range" class="max-w-sm w-full">
        {{-- <div class="mb-2 text-sm font-normal">Rango de fechas:</div> --}}
        <div class="relative">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <!-- Calendar Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
            <input type="text" x-ref="inputDate"
                class="w-full text-[13px] rounded-md bg-white border-none py-1 pl-12 pr-3 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500
                sm:leading-6">
        </div>
    </div>
</div>

@push('scripts-dates')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
@endpush

@script
<script>
    Alpine.data('range', () => ({
        startDate: $wire.entangle('startDate'),
        endDate: $wire.entangle('endDate'),
        ranges: {},
        init() {
            moment.locale('es');

            // Predefined date ranges with calculations
            const predefinedRanges = {
                'Último mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'Hoy': [moment().startOf('day'), moment().endOf('day')],
                'Próximos 7 días': [moment(), moment().add(6, 'days')],
                'Próximos 15 días': [moment(), moment().add(14, 'days')],
                'Próximos 30 días': [moment(), moment().add(29, 'days')],
                'Anteriores 7 días': [moment().subtract(7, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
                'Anteriores 15 días': [moment().subtract(15, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
                'Anteriores 30 días': [moment().subtract(30, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
                'Mes actual': [moment().startOf('month'), moment().endOf('month')],
                'Año actual': [moment().startOf('year'), moment().endOf('year')],
                'Personalizado': null, // Placeholder for custom range
            };

            // Build ranges object based on options passed from PHP
            const options = @json($rangeOptions);
            this.ranges = {};
            options.forEach((option) => {
                if (predefinedRanges[option]) {
                    this.ranges[option] = predefinedRanges[option];
                }
            });

            // If defaultRange is set, set startDate and endDate accordingly
            if ($wire.defaultRange && predefinedRanges[$wire.defaultRange]) {
                this.startDate = predefinedRanges[$wire.defaultRange][0].format('DD/MM/YYYY');
                this.endDate = predefinedRanges[$wire.defaultRange][1].format('DD/MM/YYYY');
            }

            // Initialize the date picker
            $(this.$refs.inputDate).daterangepicker({
                startDate: this.startDate,
                endDate: this.endDate,
                locale: {
                    format: 'DD/MM/YYYY',
                    separator: ' - ',
                    applyLabel: 'Aplicar',
                    cancelLabel: 'Cancelar',
                    fromLabel: 'Desde',
                    toLabel: 'Hasta',
                    customRangeLabel: 'Personalizado',
                    weekLabel: 'S',
                    daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
                        'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ],
                    firstDay: 1 // Monday as the first day of the week
                },
                ranges: this.ranges,
            }, (start, end) => {
                this.startDate = start.format('DD/MM/YYYY');
                this.endDate = end.format('DD/MM/YYYY');
                Livewire.dispatch('dateRange', {
                    start: this.startDate,
                    end: this.endDate
                });
            });

            // Watch for changes in startDate and endDate
            $wire.watch('startDate', () => {
                $(this.$refs.inputDate).data('daterangepicker').setStartDate(this.startDate);
            });

            $wire.watch('endDate', () => {
                $(this.$refs.inputDate).data('daterangepicker').setEndDate(this.endDate);
            });
        },
    }));
</script>
@endscript
