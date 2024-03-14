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
                                @foreach ($cars as $row)
                                <option value="{{ $row->id }}" data-price="{{ $row->tarif_sewa }}">{{ $row->merek }} - Tersisa {{ $row->stock }} Unit</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('mobil_id')" />
                        </div>
                        <div>
                            <x-input-label for="tanggal_mulai" :value="__('Tanggal Sewa')" />
                            <x-text-input id="tanggal_mulai" name="tanggal_mulai" type="date" class="mt-1 block w-full" required autofocus autocomplete="tanggal_mulai" />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_mulai')" />
                        </div>
                        <div>
                            <x-input-label for="tanggal_selesai" :value="__('Tanggal Selesai')" />
                            <x-text-input id="tanggal_selesai" name="tanggal_selesai" type="date" class="mt-1 block w-full" required autofocus autocomplete="tanggal_selesai" />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_selesai')" />
                        </div>

                        <div>
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" disabled required autofocus autocomplete="price" />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'Car berhasil disewa!')
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

    @section('script')

    <script>

document.addEventListener('DOMContentLoaded', function () {
        let valueMulai = document.querySelector('#tanggal_mulai');
        let valueSelesai = document.querySelector('#tanggal_selesai');
        let mobilId = document.querySelector('#mobil_id');
        let priceInput = document.querySelector('#price');

        // Event listener untuk input tanggal mulai dan tanggal selesai
        valueMulai.addEventListener('change', hitungTotalSewa);
        valueSelesai.addEventListener('change', hitungTotalSewa);

        // Event listener untuk input mobil
        mobilId.addEventListener('change', hitungTotalSewa);

        // Fungsi untuk menghitung harga total sewa
        function hitungTotalSewa() {
            let tglStart = new Date(valueMulai.value);
            let tglEnd = new Date(valueSelesai.value);
            let Difference_In_Time = tglEnd.getTime() - tglStart.getTime();
            let differenceDays = Math.round(Difference_In_Time / (1000 * 3600 * 24));

            let priceMb = mobilId.options[mobilId.selectedIndex].getAttribute('data-price');
            let total = priceMb * differenceDays;

            priceInput.value = total; // Memperbarui nilai input harga
        }
    });



    </script>

    @endsection
</x-app-layout>
