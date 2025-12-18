<div>
    <main class="grow">
        {{-- <!-- Overview Section --> --}}
        <div class="mb-8">
            <h1 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">Internet Desa Overview</h1>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-2 sm:gap-6">

                {{-- <!-- Internet Provider Card --> --}}
                <livewire:kosadata.pages.overview.section.isp-card />

                <livewire:kosadata.pages.overview.section.internet-desa-input-card />

            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 mb-8 lg:grid-cols-3">
            <livewire:kosadata.pages.overview.section.provider-by-kecamatan-card lazy />
            <livewire:kosadata.pages.overview.section.kecamatan-by-provider-card lazy />
            <livewire:kosadata.pages.overview.section.provider-chart-card lazy />
        </div>

    </main>
</div>