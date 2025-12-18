<div class="p-5 transition-all bg-white shadow-md dark:bg-gray-800 rounded-2xl hover:shadow-lg">
    @assets
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endassets

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">All Internet Providers</h2>
    </div>

    <div>

        <x-core::chart type="pie" :labels="$this->availableProviders->pluck('provider.name')" :datasets="[
        [
            'data' => $this->availableProviders->pluck('total'),
        ]
    ]" />

    </div>
</div>