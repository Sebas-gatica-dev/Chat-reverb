<div>
    <div x-data="{ checked: @entangle('checked').live }">

        <div class="inline-flex items-center gap-2">
            <span class="text-sm {{ $dark ? 'text-white' : 'text-gray-900' }}">{{ $answer }}</span>
            <button type="button"
                class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 bg-gray-200"
                role="switch" aria-checked="false" :aria-checked="checked.toString()" @click="checked = !checked" x-state:on="Enabled"
                x-state:off="Not Enabled" :class="{ 'bg-indigo-600': checked, 'bg-gray-200': !(checked) }">
                <span class="sr-only">{{ $answer }}</span>
                <span
                    class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out translate-x-0"
                    x-state:on="Enabled" x-state:off="Not Enabled"
                    :class="{ 'translate-x-5': checked, 'translate-x-0': !(checked) }">
                    <span
                        class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity opacity-100 duration-200 ease-in"
                        aria-hidden="true" x-state:on="Enabled" x-state:off="Not Enabled"
                        :class="{ 'opacity-0 duration-100 ease-out': checked, 'opacity-100 duration-200 ease-in': !(checked) }">
                        <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 12 12">
                            <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    <span
                        class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity opacity-0 duration-100 ease-out"
                        aria-hidden="true" x-state:on="Enabled" x-state:off="Not Enabled"
                        :class="{ 'opacity-100 duration-200 ease-in': checked, 'opacity-0 duration-100 ease-out': !(checked) }">
                        <svg class="h-3 w-3 text-indigo-600" fill="currentColor" viewBox="0 0 12 12">
                            <path
                                d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z">
                            </path>
                        </svg>
                    </span>
                </span>
            </button>
        </div>

        @if ($breakdown)
            <div class="grid w-full gap-x-6 gap-y-8 grid-cols-9 md:col-span-2 ring-1 ring-gray-900/5 sm:rounded-xl mt-6"
                x-show="on" x-cloak>
                <div class="col-span-full">
                    <h2 class="text-base font-semibold leading-6 text-white">{{ $title }} </h2>
                    <p class="mt-2 text-sm text-gray-300">{{ $subtitle }}</p>
                </div>
                <div class="col-span-6">

                    {{ $content }}

                </div>


            </div>
        @endif

    </div>
</div>
