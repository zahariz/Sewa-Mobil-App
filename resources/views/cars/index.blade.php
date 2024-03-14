<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Master Car
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @session('status')
            <div class="p-4 bg-green-100">
                {{ $value }}
            </div>
             @endsession
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-full">
                    <div class="flex justify-between">
                        <div class="mb-1">
                            <a href="{{ route('cars.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Create New</a>
                        </div>
                        <form action="{{ route('cars.index') }}" method="GET">
                            <div class="mb-4">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="p-2 border border-gray-300 rounded-md">
                                <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md">Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Merek
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Model
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        No Plat
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Stock
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $row)

                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$row->merek}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $row->model }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $row->nomor_plat }}
                                    </td>
                                    <td class="px-6 py-4">
                                        Rp. {{ $row->tarif_sewa }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $row->stock }} Unit
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium flex">
                                        <a href="{{ route('cars.edit', $row->id) }}" class="inline-flex items-center px-4 py-2 bg-sky-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-500 active:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-1">Edit</a>
                                        <x-danger-button
                                            x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-cars-deletion')"
                                        >{{ __('Delete Cars') }}</x-danger-button>


                                        <x-modal name="confirm-cars-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                                @csrf
                                                @method('delete')

                                                <h2 class="text-lg font-medium text-gray-900">
                                                    {{ __('Are you sure you want to delete your cars?') }}
                                                </h2>

                                                <p class="mt-1 text-sm text-gray-600">
                                                    {{ __('Once your cars is deleted, all of its resources and data will be permanently deleted.') }}
                                                </p>

                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Cancel') }}
                                                    </x-secondary-button>

                                                    <x-danger-button class="ms-3">
                                                        {{ __('Delete Cars') }}
                                                    </x-danger-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </td>
                                </tr>

                                @endforeach


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>
