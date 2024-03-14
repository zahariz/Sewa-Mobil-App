<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Master Car
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('cars.update', $cars->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')
                        <div>
                            <x-input-label for="merek" :value="__('Merek')" />
                            <x-text-input id="merek" name="merek" type="text" class="mt-1 block w-full" :value="old('merek', $cars->merek)" required autofocus autocomplete="merek" />
                            <x-input-error class="mt-2" :messages="$errors->get('merek')" />
                        </div>
                        <div>
                            <x-input-label for="model" :value="__('Model')" />
                            <x-text-input id="model" name="model" type="text" class="mt-1 block w-full" :value="old('model', $cars->model)" required autofocus autocomplete="model" />
                            <x-input-error class="mt-2" :messages="$errors->get('model')" />
                        </div>
                        <div>
                            <x-input-label for="nomor_plat" :value="__('No Plat')" />
                            <x-text-input id="nomor_plat" name="nomor_plat" type="text" class="mt-1 block w-full" :value="old('nomor_plat', $cars->nomor_plat)" required autofocus autocomplete="nomor_plat" />
                            <x-input-error class="mt-2" :messages="$errors->get('nomor_plat')" />
                        </div>
                        <div>
                            <x-input-label for="tarif_sewa" :value="__('Tarif Sewa')" />
                            <x-text-input id="tarif_sewa" name="tarif_sewa" type="number" class="mt-1 block w-full" :value="old('tarif_sewa', $cars->tarif_sewa)" required autofocus autocomplete="tarif_sewa" />
                            <x-input-error class="mt-2" :messages="$errors->get('tarif_sewa')" />
                        </div>
                        <div>
                            <x-input-label for="stock" :value="__('Stock')" />
                            <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full" :value="old('stock', $cars->stock)" required autofocus autocomplete="stock" />
                            <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                        </div>


                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'Cars succesfully updated!')
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
