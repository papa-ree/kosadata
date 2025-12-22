<div>
    <a href="{{ route('kosadata.internet-provider.index') }}" wire:navigate.hover>
        <div class="p-5 transition-all bg-white shadow-md dark:bg-gray-800 rounded-2xl hover:shadow-lg">
            <div class="flex items-start justify-between">
                <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-building2-icon lucide-building-2 dark:text-blue-400 text-blue-500">
                        <path d="M10 12h4" />
                        <path d="M10 8h4" />
                        <path d="M14 21v-3a2 2 0 0 0-4 0v3" />
                        <path d="M6 10H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2" />
                        <path d="M6 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16" />
                    </svg>
                </div>
                <span
                    class="px-2 py-1 text-xs text-green-800 bg-green-100 rounded-full dark:bg-green-900/30 dark:text-green-400">Active</span>
            </div>
            <h3 class="mt-4 mb-1 text-lg font-medium text-gray-700 dark:text-gray-300">Internet Providers
            </h3>
            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $internet_provider_count }}
            </p>
            <div class="flex items-center mt-4 text-xs gap-x-1">
                <span class="ml-1 text-gray-600 dark:text-gray-400">
                    Click to go to Internet Provider List
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-arrow-up-right dark:text-white">
                    <path d="M7 7h10v10" />
                    <path d="M7 17 17 7" />
                </svg>
            </div>
        </div>
    </a>
</div>