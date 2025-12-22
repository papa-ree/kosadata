<div class="p-6 transition-all bg-white shadow-md dark:bg-gray-800 rounded-2xl hover:shadow-lg">
    <div class="flex items-center justify-between mb-6">
        <div class="">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Provider</h2>
            <p class="text-gray-700 text-sm dark:text-white">
                Number of kecamatan using the provider
            </p>
        </div>
        {{-- <a href="{{ route('kosadata.isp-desa.index') }}" wire:navigate:hover
            class="flex items-center px-3 py-1 text-sm rounded-lg text-primary-500 dark:text-primary-400 hover:bg-gray-100 dark:hover:bg-gray-700">
            View All
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="ml-1 lucide lucide-chevron-right">
                <path d="m9 18 6-6-6-6" />
            </svg>
        </a> --}}
    </div>
    <div
        class="overscroll-auto overflow-auto max-h-80 scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-300 scrollbar-thumb-rounded-full scrollbar-track-rounded-full">
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-gray-700 uppercase dark:text-gray-300 bg-gray-50 dark:bg-gray-700/50">
                <tr>
                    <th class="px-4 py-3">Provider</th>
                    <th class="px-4 py-3 text-end">Kecamatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->providerKecamatanCount as $row)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                            {{ $row->provider->name }}
                        </td>
                        <td class="px-4 py-3 text-end dark:text-white">
                            {{ $row->total_kecamatan }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>