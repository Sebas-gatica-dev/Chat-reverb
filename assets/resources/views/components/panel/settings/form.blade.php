<div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">

    <div class="px-4 py-6 sm:p-8">
        <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-9">

            {{ $slot }}


        </div>
    </div>


    @if($buttons)
    <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
        {{ $buttons  }}

    </div>
    @endif
</div>
