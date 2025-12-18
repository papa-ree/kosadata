<div>
    <x-core::table :links="$this->availableIspDesas" header>

        <x-slot name="thead">
            <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                    <div class="flex items-center gap-x-2">
                        <span class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-gray-200">
                            Service Provider Name
                        </span>
                    </div>
                </th>
                <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    <div class="flex items-center gap-x-2">
                        <span class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-gray-200">
                            Contact Name
                        </span>
                    </div>
                </th>
                <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 md:table-cell">
                    <div class="flex items-center gap-x-2">
                        <span class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-gray-200">
                            User
                        </span>
                    </div>
                </th>
                <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 md:table-cell">
                    <div class="flex items-center gap-x-2">
                        <span class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-gray-200">
                            Desa - Kecamatan
                        </span>
                    </div>
                </th>
                <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                    <div class="flex items-center gap-x-2">
                        <span class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-gray-200">
                            Created At
                        </span>
                    </div>
                </th>
                <th scope="col" class="relative py-3.5 pl-3 pr-4">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
        </x-slot>

        <x-slot name="tbody">
            @foreach ($this->availableIspDesas as $isp)
                <tr wire:key='isp-{{ $isp->id }}'>
                    <td class="w-full py-4 pl-4 pr-3 text-sm font-medium text-gray-900 max-w-0 sm:w-auto sm:max-w-none">
                        <a href="{{ route('kosadata.isp-desa.edit', $isp->id) }}" wire:navigate.hover
                            class="block text-sm font-semibold text-gray-800 transition ease-in-out dark:text-gray-200 hover:text-emerald-600 dark:hover:text-emerald-400">
                            {{ $isp->name }}
                        </a>
                        <dl class="font-normal lg:hidden">
                            <dt class="sr-only sm:hidden">Created At</dt>
                            <dd class="mt-1 text-gray-500 truncate sm:hidden">
                                <span class="block text-xs text-gray-500">Created At {{ $isp->created_at }}</span>
                            </dd>
                        </dl>
                    </td>

                    <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">
                        <span class="block text-sm font-semibold text-gray-800">{{ $isp->contact_name }}</span>
                        <span class="block text-xs text-gray-500">{{ $isp->contact_phone }}</span>
                    </td>

                    <td class="hidden px-3 py-4 text-sm text-gray-500 md:table-cell">
                        <span class="block text-sm font-semibold text-gray-800">{{ $isp->user_name }}</span>
                        <span class="block text-xs text-gray-500">{{ $isp->user_job }}</span>
                    </td>

                    <td class="hidden px-3 py-4 text-sm text-gray-500 md:table-cell">
                        <span class="block text-sm font-semibold text-gray-800">{{ $isp->desa->name }}</span>
                        <span class="text-xs rounded-full bg-emerald-100 px-2.5 py-0.5 text-gray-600">
                            {{ $isp->kecamatan->name }}
                        </span>
                    </td>

                    <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                        <span class="block text-sm text-gray-500">{{ $isp->created_at }}</span>
                    </td>

                    <td class="py-4 pl-3 pr-4 text-sm font-medium text-right ">
                        <x-core::option wire:key="{{ $isp->id }}" :item="$isp->id" :itemId="$isp->id"
                            route="kosadata.isp-desa.edit" :deleteButton="true" />
                    </td>
                </tr>
            @endforeach
        </x-slot>

    </x-core::table>
</div>