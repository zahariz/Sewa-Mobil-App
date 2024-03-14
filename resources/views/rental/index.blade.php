<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            History Rental
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
                    <div class="mb-1">
                        <a href="{{ route('rental.cars.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Create New</a>
                    </div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Mobil
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Penyewa
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal Sewa
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal Selesai
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rental as $row)

                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $row['mobil']['merek'] }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $row['user']['name'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $row['tanggal_mulai'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $row['tanggal_selesai'] }}
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
