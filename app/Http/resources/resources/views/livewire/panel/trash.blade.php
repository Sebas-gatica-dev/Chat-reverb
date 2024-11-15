<div>
    <!--
  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->

    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Papelera de reciclaje</h1>
                </div>


            </div>
        </div>


    </header>


    <div class="mx-auto max-w-screen-2xl md:px-6 lg:px-8">

        <div class="mt-1 flow-root">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full py-6 align-middle md:px-6 lg:px-8">

                    <div
                        class=" divide-y divide-gray-300 bg-white ring-1 ring-black ring-opacity-5 md:rounded-lg
                md:shadow">


                        <div class="">

                            <div class="mt-8 flow-root">
                                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                        <div class="relative">
                                            <!-- Selected row actions, only show when rows are selected. -->
                                            <!-- <div class="absolute top-0 left-14 flex h-12 items-center space-x-3 bg-white sm:left-12"> -->
                                            <!--   <button type="button" class="inline-flex items-center rounded bg-white px-2 py-1 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-white">Bulk edit</button> -->
                                            <!--   <button type="button" class="inline-flex items-center rounded bg-white px-2 py-1 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-white">Delete all</button> -->
                                            <!-- </div> -->

                                            <table class="min-w-full table-fixed divide-y divide-gray-300">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="relative px-7 sm:w-12 sm:px-6">
                                                            <input type="checkbox"
                                                                class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                        </th>
                                                        <th scope="col"
                                                            class="min-w-[12rem] py-3.5 pr-3 text-left text-sm font-semibold text-gray-900">
                                                            Descripción</th>
                                                        <th scope="col"
                                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                            Tipo</th>
                                                        <th scope="col"
                                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                            Eliminado por</th>
                                                        <th scope="col"
                                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                            Fecha de eliminación</th>
                                                        <th scope="col"
                                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                            Borrado permanente</th>
                                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-3">
                                                            <span class="sr-only">Acciones</span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-gray-200 bg-white">
                                                    <!-- Selected: "bg-gray-50" -->
                                                
                                                    @forelse ($trashes as $trash)
                                                        <tr>
                                                            <td class="relative px-7 sm:w-12 sm:px-6">
                                                                <!-- Selected row marker, only show when row is selected. -->
                                                                <!-- <div class="absolute inset-y-0 left-0 w-0.5 bg-indigo-600"></div> -->

                                                                <input type="checkbox"
                                                                    class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                            </td>
                                                            <!-- Selected: "text-indigo-600", Not Selected: "text-gray-900" -->
                                                            <td
                                                                class="whitespace-nowrap py-4 pr-3 text-sm font-medium text-gray-900">


                                                                {{-- {{ $trash->data['address'] }}</td> --}}  
                                                            
                                                                @if($trash->data['description'])
                                                                {{ $trash->data['description'] }}
                                                                @else
                                                              n/a
                                                                @endif
                                                            
                                                            </td>
                                                            <td class="py-4 px-3 text-sm text-gray-500">

                                                                {{ App\Enums\ModelTypeEnum::getModelType($trash->trashable_type) }}
                                                            </td>
                                                            <td class="py-4 px-3 text-sm text-gray-500">
                                                                {{ $trash->user->name }}</td>
                                                            <td class="py-4 px-3 text-sm text-gray-500">
                                                                {{ $trash->created_at->diffForHumans() }}</td>
                                                            <td class="py-4 px-3 text-sm text-gray-500">
                                                                {!! $trash->deleted_at
                                                                    ? $trash->deleted_at->diffForHumans()
                                                                    : '<span class="inline-flex items-center rounded-md bg-gray-50 px-1.5 py-0.5 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">Se eliminara en 30 días</span>
                                                                                                                                ' !!}</td>
                                                            <td class="py-4 pl-3 pr-4 sm:pr-3">
                                                                @if (!$trash->deleted_at)
                                                                    <div
                                                                        class="flex justify-end items-center space-x-3">

                                                                 @can('access-function', 'trash-restore')
                                                                        <button
                                                                            wire:click="restore('{{ $trash->id }}')"
                                                                            class="text-indigo-600 hover:text-indigo-900">Restaurar</button>
                                                                 @endcan
                                                                  @can('access-funtion','trash-destroy')
                                                                        <button
                                                                            wire:click="delete('{{ $trash->id }}')"
                                                                            class="text-indigo-600 hover:text-indigo-900">Eliminar
                                                                            permanentemente</button>
                                                                    </div>
                                                                    @endcan
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="relative w-full" colspan="12">
                                                                <div class="rounded-md bg-yellow-50 p-4 text-center">

                                                                    <div class="flex justify-center">
                                                                        <div class="mr-1">

                                                                            <svg class="h-5 w-5 text-yellow-400"
                                                                                viewBox="0 0 20 20" fill="currentColor"
                                                                                aria-hidden="true">
                                                                                <path fill-rule="evenodd"
                                                                                    d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z"
                                                                                    clip-rule="evenodd" />
                                                                            </svg>
                                                                        </div>
                                                                        <h3
                                                                            class=" text-center text-sm font-medium text-yellow-800">
                                                                            No se eliminó ningún registro todavía.
                                                                    </div>
                                                                    <div class="mt-2 text-sm text-yellow-700">
                                                                        <p>Los registros eliminados se muestran aquí y
                                                                            se pueden restaurar o eliminar
                                                                            permanentemente.</p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforelse

                                                    <!-- More people... -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
