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
                    <form method="post" action="{{ route('rental.cars.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="mobil_id" :value="__('Mobil')" />
                            <select name="mobil_id" id="mobil_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                <option selected>Choose a car</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('mobil_id')" />
                        </div>
                        <div>
                            <x-input-label for="tanggal_mulai" :value="__('Tanggal Sewa')" />
                            <x-text-input id="tanggal_mulai" name="tanggal_mulai" type="text" class="mt-1 block w-full" required autofocus autocomplete="tanggal_mulai" />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_mulai')" />
                        </div>
                        <div>
                            <x-input-label for="tanggal_selesai" :value="__('Tanggal Selesai')" />
                            <x-text-input id="tanggal_selesai" name="tanggal_selesai" type="text" class="mt-1 block w-full" required autofocus autocomplete="tanggal_selesai" />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_selesai')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'Cars succesfully created!')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
