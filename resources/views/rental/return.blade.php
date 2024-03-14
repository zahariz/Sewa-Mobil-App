<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Rental Car
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <form method="post" action="{{ route('rental.cars.returned') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('delete')
                        <div>
                            <x-input-label for="nomor_plat" :value="__('Mobil')" />
                            <select name="nomor_plat" id="nomor_plat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                <option selected>Choose a car</option>
                                @foreach ($transaction as $row)
                                <option value="{{ $row->id }}">{{ $row['mobil']['nomor_plat'] }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('nomor_plat')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Return') }}</x-primary-button>

                            @if (session('status') === 'Car berhasil disewa!')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Returned.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
