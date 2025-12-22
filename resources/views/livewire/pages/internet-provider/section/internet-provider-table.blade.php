<div>
    <x-core::table :links="$this->availableInternetProviders" header>

        <x-slot name="thead">
            <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                    <div class="flex items-center gap-x-2">
                        <span class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-gray-200">
                            Name
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
            @foreach ($this->availableInternetProviders as $isp)
                <tr wire:key='isp-{{ $isp->id }}'>
                    <td class="w-full py-4 pl-4 pr-3 text-sm font-medium text-gray-900 max-w-0 sm:w-auto sm:max-w-none">
                        <a href="{{ route('kosadata.internet-provider.edit', $isp->id) }}" wire:navigate.hover
                            class="block text-sm text-gray-800 transition ease-in-out dark:text-gray-200 hover:text-emerald-600 dark:hover:text-emerald-400">
                            {{ $isp->name }}
                        </a>
                        <dl class="font-normal lg:hidden">
                            <dt class="sr-only sm:hidden">Created At</dt>
                            <dd class="mt-1 text-gray-500 truncate sm:hidden">
                                <span class="block text-xs text-gray-500">Created At {{ $isp->created_at }}</span>
                            </dd>
                        </dl>
                    </td>

                    <td class="hidden px-3 py-4 text-sm text-gray-500 md:table-cell">
                        <span class="block text-sm text-gray-500">{{ $isp->created_at }}</span>
                    </td>

                    <td class="py-4 pl-3 pr-4 text-sm font-medium text-right ">
                        <x-core::option wire:key="{{ $isp->id }}" item="{{$isp->id}}" itemId="{{$isp->id}}"
                            route="kosadata.internet-provider.edit" :deleteButton="$isp->ispDesas->count() == 0 ? true : false" />
                    </td>
                </tr>
            @endforeach
        </x-slot>

    </x-core::table>
</div>