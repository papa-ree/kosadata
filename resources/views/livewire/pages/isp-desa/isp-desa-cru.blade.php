<div>
    <x-core::back-breadcrumb :href="route('kosadata.isp-desa.index')" label="Internet Desa" />

    <div class="sm:w-1/3">
        <x-core::page-container>
            <form wire:submit='{{ $editMode ? 'update' : 'store' }}'>

                <div class="mb-4 sm:mb-6">
                    <x-core::input label="internet provider name" wire:model='name' />
                    <x-core::input-error for="name" />
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