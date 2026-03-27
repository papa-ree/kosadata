<div class="p-5 transition-all bg-white shadow-md dark:bg-gray-800 rounded-2xl hover:shadow-lg">
    <div class="flex items-start justify-between">
        <div class="p-3 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-activity-icon lucide-activity dark:text-emerald-400 text-emerald-500">
                <path
                    d="M22 12h-2.48a2 2 0 0 0-1.93 1.46l-2.35 8.36a.25.25 0 0 1-.48 0L9.24 2.18a.25.25 0 0 0-.48 0l-2.35 8.36A2 2 0 0 1 4.49 12H2" />
            </svg>
        </div>
        <span
            class="px-2 py-1 text-xs rounded-full text-emerald-800 bg-emerald-100 dark:bg-emerald-900/30 dark:text-emerald-400">
            {{ number_format($progress_percentage) }}%
            input
        </span>
    </div>
    <h3 class="mt-4 mb-1 text-lg font-medium text-gray-700 dark:text-gray-300">Data Input Progress</h3>
    <p class="text-2xl font-semibold">
        <span class="text-emerald-400 dark:text-emerald-300">{{ $desa_with_data_count }}</span>
        <span class="dark:text-white">/</span>
        <span class="text-red-400 dark:text-red-300">{{ $desa_total_count }}</span>
    </p>
    <div class="w-full h-2 mt-4 bg-red-400 rounded-full dark:bg-red-700">
        <div class="h-2 rounded-full bg-emerald-400" style="width: {{ $progress_percentage }}%">
        </div>
    </div>
</div>