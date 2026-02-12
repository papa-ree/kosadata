<div>
    <x-core::breadcrumb :href="route('kosadata.internet-provider.index')" label="Internet Provider list" />

    <div class="sm:w-1/3">
        <x-core::page-container>
            <form wire:submit='{{ $editMode ? 'update' : 'store' }}'>

                <div class="mb-4 sm:mb-6">
                    <x-core::input label="internet provider name" wire:model='name' />
                    <x-core::input-error for="name" />
                </div>

                <div class="mb-4 sm:mb-6">
                    <x-core::input label="description" wire:model='description' />
                    <x-core::input-error for="description" />
                </div>

                <div class="flex justify-end items-center">
                    <x-core::button label="{{ $editMode ? 'update' : 'store' }}" />
                </div>

            </form>
        </x-core::page-container>
    </div>
</div>