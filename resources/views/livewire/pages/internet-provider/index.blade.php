<div>
    <x-core::page-header title="Internet Provider" subtitle="Manage all existing Internet Provider or add a new one">
        <x-slot name="action">
            <x-core::button type="button" label="add internet provider" link
                :href="route('kosadata.internet-provider.create')" class="justify-center" />
        </x-slot>
    </x-core::page-header>
    <livewire:kosadata.pages.internet-provider.section.internet-provider-table />
</div>