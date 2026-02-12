<div>
    <x-core::breadcrumb :href="route('kosadata.isp-desa.index')" label="Internet Desa" />

    <div class="sm:w-1/3">
        <x-core::page-container>
            <form wire:submit='{{ $editMode ? 'update' : 'store' }}'>

                <div class="mb-4 sm:mb-6">
                    <label for="provider" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Internet Provider
                    </label>
                    <select wire:model="internet_provider_id"
                        class="block w-full py-3 px-4 text-gray-900 placeholder-gray-500 transition-all duration-200 bg-white border border-gray-300 form-input dark:border-gray-600 rounded-xl dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                        <option value="">
                            Pilih
                        </option>

                        @foreach ($this->availableProviders as $provider)
                            <option value="{{ $provider->id }}">
                                {{ $provider->name }}
                            </option>
                        @endforeach

                    </select>
                    <x-core::input-error for="internet_provider_id" />
                </div>

                <div class="mb-4 sm:mb-6">
                    <x-core::input label="internet provider name" wire:model='contact_name' />
                    <x-core::input-error for="contact_name" />
                </div>

                <div class="mb-4 sm:mb-6">
                    <x-core::input label="internet provider name" wire:model='contact_phone' />
                    <x-core::input-error for="contact_phone" />
                </div>

                <div class="mb-4 sm:mb-6">
                    <x-core::input label="internet provider name" wire:model='user_name' />
                    <x-core::input-error for="user_name" />
                </div>

                <div class="mb-4 sm:mb-6">
                    <x-core::input label="internet provider name" wire:model='user_job' />
                    <x-core::input-error for="user_job" />
                </div>

                <div class="flex justify-end items-center">
                    <x-core::button label="{{ $editMode ? 'update' : 'store' }}" />
                </div>

            </form>
        </x-core::page-container>
    </div>
</div>