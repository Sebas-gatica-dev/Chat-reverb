@props(['customer' => $customer])

    @if ($customer->properties->count() == 1)
        <div class="text-xs leading-5 text-gray-500 sm:mt-1 sm:text-gray-600 md:text-sm ">
            {{ Str::words($customer->properties->first()->address, 2) }}</div>
    @elseif($customer->properties->count() > 1)
        <span
            class="text-xs leading-5 text-gray-500 rounded-md px-2 py-0  border border-gray-200 bg-gray-100 sm:mt-1 sm:font-medium sm:text-gray-500  md:px-1 md:py-0 lg:py-1  lg:text-sm">
            {{ $customer->properties->count() }} propiedades
        </span>
    @endif

    {{-- @if ($customer->phones->count() > 0)
        <div class="text-xs leading-5 text-gray-500  sm:text-xs sm:mt-1">
            {{ $customer->phones->first()->phone }}</div>
    @endif --}}
