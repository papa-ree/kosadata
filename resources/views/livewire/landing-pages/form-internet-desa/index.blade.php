<div>

    <div class="flex items-center justify-center min-h-full px-4 pt-5 sm:px-6 lg:px-8" wire:cloak>

        <div class="absolute p-0.5 left-3 top-3">
            <a href="/" class="select-none flex items-center dark:text-white text-gray-800 sm:gap-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="size-6 lucide lucide-arrow-left-icon lucide-arrow-left">
                    <path d="m12 19-7-7 7-7" />
                    <path d="M19 12H5" />
                </svg>
                <span class="sm:block hidden">Kembali ke halaman utama</span>
            </a>
        </div>

        {{-- <!-- Theme Toggle --> --}}
        <div class="absolute p-0.5 rounded-full bg-emerald-300 right-3 top-3">
            <x-core::dark-mode-toggle />
        </div>

        <div class="w-full max-w-lg space-y-8" x-data="{
            disabledButton: false,
            showRecaptchaMessage: false,
            showAddProviderInput: false,

            isSend: $wire.entangle('sended').live,
            kecamatanId: $wire.entangle('kecamatan_id').live,
            desaId: $wire.entangle('desa_id').live,

            providerName: '',

            desasByKecamatan: @js($desaByKecamatan),
            desas: [],

            updateDesas() {
                if (!this.kecamatanId) {
                    this.desas = [];
                    this.desaId = null;
                    return;
                }

                const key = String(this.kecamatanId);
                this.desas = this.desasByKecamatan?.[key] ?? [];
            }
        }" x-init="updateDesas()">

            {{-- <!-- Header --> --}}
            <div class="text-center">
                <div
                    class="flex items-center justify-center w-16 h-16 mx-auto mb-4 shadow-lg bg-emerald-500 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-white lucide lucide-notebook-pen-icon lucide-notebook-pen">
                        <path d="M13.4 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-7.4" />
                        <path d="M2 6h4" />
                        <path d="M2 10h4" />
                        <path d="M2 14h4" />
                        <path d="M2 18h4" />
                        <path
                            d="M21.378 5.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
                    </svg>
                </div>
                <h2 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">
                    Form Pendataan Internet Desa
                </h2>
                {{-- <p class="text-lg text-gray-600 dark:text-gray-400">
                    Pendataan
                </p> --}}
            </div>

            {{-- <!-- Form Card --> --}}
            <div
                class="p-6 transition-all duration-300 bg-white shadow-xl dark:bg-gray-800 rounded-2xl sm:p-8 hover:shadow-2xl">

                <form wire:submit='store(Object.fromEntries(new FormData($event.target)))' class="space-y-6 select-none"
                    x-show="!isSend" wire:recaptcha>

                    {!! RecaptchaV3::field('store') !!}

                    <div
                        class="flex items-center py-3 text-xs text-gray-400 uppercase before:flex-1 before:border-t before:border-gray-200 before:me-6 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-neutral-500 dark:before:border-neutral-600 dark:after:border-neutral-600">
                        Data Desa
                    </div>

                    {{-- Kecamatan --}}
                    <div>
                        <label for="kecamatan" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Kecamatan
                        </label>
                        <div class="relative">

                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="w-4 h-4 text-gray-400 lucide lucide-university-icon lucide-university">
                                    <path d="M14 21v-3a2 2 0 0 0-4 0v3" />
                                    <path d="M18 12h.01" />
                                    <path d="M18 16h.01" />
                                    <path
                                        d="M22 7a1 1 0 0 0-1-1h-2a2 2 0 0 1-1.143-.359L13.143 2.36a2 2 0 0 0-2.286-.001L6.143 5.64A2 2 0 0 1 5 6H3a1 1 0 0 0-1 1v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2z" />
                                    <path d="M6 12h.01" />
                                    <path d="M6 16h.01" />
                                    <circle cx="12" cy="10" r="2" />
                                </svg>
                            </div>

                            <select x-model="kecamatanId" @change="updateDesas()"
                                class="block w-full py-3 pl-10 pr-3 text-gray-900 placeholder-gray-500 transition-all duration-200 bg-white border border-gray-300 form-input dark:border-gray-600 rounded-xl dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                                <option value="">Pilih Kecamatan</option>

                                @foreach ($availableKecamatans as $kecamatan)
                                    <option value="{{ $kecamatan->id }}">
                                        {{ $kecamatan->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <x-core::input-error for="kecamatan_id" />
                    </div>

                    {{-- Desa --}}
                    <div>
                        <label for="desa" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Desa
                        </label>

                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="w-4 h-4 text-gray-400 lucide lucide-house-icon lucide-house">
                                    <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                                    <path
                                        d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                </svg>
                            </div>

                            <select x-model="desaId" :disabled="!kecamatanId"
                                class="block w-full py-3 pl-10 pr-3 disabled:bg-gray-100 disabled:dark:bg-gray-800 disabled:text-gray-500 text-gray-900 placeholder-gray-500 transition-all duration-200 bg-white border border-gray-300 form-input dark:border-gray-600 rounded-xl dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                                <option value="">
                                    <span
                                        x-text="kecamatanId ? 'Pilih Desa' : 'Pilih Kecamatan terlebih dahulu'"></span>
                                </option>

                                <template x-for="desa in desas" :key="desa.id">
                                    <option :value="desa.id" x-text="desa.name"></option>
                                </template>
                            </select>
                        </div>
                        <x-core::input-error for="desa_id" />
                    </div>

                    {{-- nama pengisi --}}
                    <div>
                        <label for="user-name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Petugas Desa
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="w-4 h-4 text-gray-400 lucide lucide-user-icon lucide-user">
                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>
                            </div>
                            <input type="text" id="user-name" wire:model='user_name'
                                class="block w-full py-3 pl-10 pr-3 text-gray-900 placeholder-gray-500 transition-all duration-200 bg-white border border-gray-300 form-input dark:border-gray-600 rounded-xl dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                placeholder="Nama Pengisi Form" autocomplete="off">
                        </div>
                        <x-core::input-error for="user_name" />
                    </div>

                    {{-- jabatan pengisi --}}
                    <div>
                        <label for="user-job" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Jabatan Petugas Desa
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="w-4 h-4 text-gray-400 lucide lucide-briefcase-icon lucide-briefcase">
                                    <path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                                    <rect width="20" height="14" x="2" y="6" rx="2" />
                                </svg>
                            </div>
                            <input type="text" id="user-job" wire:model='user_job'
                                class="block w-full py-3 pl-10 pr-3 text-gray-900 placeholder-gray-500 transition-all duration-200 bg-white border border-gray-300 form-input dark:border-gray-600 rounded-xl dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                placeholder="Jabatan Pengisi" autocomplete="off">
                        </div>
                        <x-core::input-error for="user_job" />
                    </div>

                    <div
                        class="flex items-center py-3 text-xs text-gray-400 uppercase before:flex-1 before:border-t before:border-gray-200 before:me-6 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-neutral-500 dark:before:border-neutral-600 dark:after:border-neutral-600">
                        Data Penyedia Internet Desa
                    </div>

                    {{-- <!-- Nama Internet Provider Field --> --}}
                    <div>
                        <label for="provider" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Pilih Penyedia Internet Desa
                        </label>
                        <div class="relative">

                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="w-4 h-4 text-gray-400 lucide lucide-building2-icon lucide-building-2">
                                    <path d="M10 12h4" />
                                    <path d="M10 8h4" />
                                    <path d="M14 21v-3a2 2 0 0 0-4 0v3" />
                                    <path
                                        d="M6 10H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2" />
                                    <path d="M6 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16" />
                                </svg>
                            </div>

                            <select wire:model="name" x-model="providerName"
                                class="block w-full py-3 pl-10 pr-3 text-gray-900 placeholder-gray-500 transition-all duration-200 bg-white border border-gray-300 form-input dark:border-gray-600 rounded-xl dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                                <option selected="" value="">
                                    Pilih
                                </option>

                                @foreach ($this->availableProviders as $provider)
                                    <option value="{{ $provider->name }}">
                                        {{ $provider->name }}
                                    </option>
                                @endforeach

                                <option value="other">
                                    {{__('Lainnya') }}
                                </option>

                            </select>
                        </div>
                        <p class="mt-1 text-sm text-blue-500 dark:text-blue-400">
                            Pilih <b>Lainnya</b> jika Penyedia Internet tidak ditemukan
                        </p>
                        <x-core::input-error for="name" />
                    </div>

                    {{-- input tambah internet provider --}}
                    <div x-show="providerName == 'other'">
                        <label for="new-internet-provider"
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Penyedia Internet
                        </label>

                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="w-4 h-4 text-gray-400 lucide lucide-building2-icon lucide-building-2">
                                    <path d="M10 12h4" />
                                    <path d="M10 8h4" />
                                    <path d="M14 21v-3a2 2 0 0 0-4 0v3" />
                                    <path
                                        d="M6 10H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2" />
                                    <path d="M6 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16" />
                                </svg>
                            </div>

                            <input type="text" id="new-internet-provider" wire:model='new_provider_name'
                                class="block w-full py-3 pl-10 pr-3 text-gray-900 placeholder-gray-500 transition-all duration-200 bg-white border border-gray-300 form-input dark:border-gray-600 rounded-xl dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                placeholder="Nama Penyedia Internet" autocomplete="off">
                        </div>
                        <x-core::input-error for="new_provider_name" />
                    </div>

                    {{-- nama contact person --}}
                    <div>
                        <label for="contact-name"
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Kontak Penyedia Internet
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="w-4 h-4 text-gray-400 lucide lucide-contact-icon lucide-contact">
                                    <path d="M16 2v2" />
                                    <path d="M7 22v-2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2" />
                                    <path d="M8 2v2" />
                                    <circle cx="12" cy="11" r="3" />
                                    <rect x="3" y="4" width="18" height="18" rx="2" />
                                </svg>
                            </div>
                            <input type="text" id="contact-name" wire:model='contact_name'
                                class="block w-full py-3 pl-10 pr-3 text-gray-900 placeholder-gray-500 transition-all duration-200 bg-white border border-gray-300 form-input dark:border-gray-600 rounded-xl dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                placeholder="Nama kontak Penyedia Internet" autocomplete="off">
                        </div>
                        <x-core::input-error for="contact_name" />
                    </div>

                    {{-- contact phone --}}
                    <div>
                        <label for="contact-phone"
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nomor HP Kontak Penyedia Internet
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="w-4 h-4 text-gray-400 lucide lucide-phone-icon lucide-phone">
                                    <path
                                        d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
                                </svg>
                            </div>
                            <input type="text" wire:model='contact_phone' x-mask="99999999999999" id="contact-phone"
                                class="block w-full py-3 pl-10 pr-3 text-gray-900 placeholder-gray-500 transition-all duration-200 bg-white border border-gray-300 form-input dark:border-gray-600 rounded-xl dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                placeholder="Contoh: 081234567890" autocomplete="off">
                        </div>
                        {{-- <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Kami membutuhkan nomor whatsapp yang aktif untuk menghubungi anda
                        </p> --}}
                        <x-core::input-error for="contact_phone" />
                    </div>

                    {{-- error message recaptcha --}}

                    <div x-on:show-recaptcha-message.window="showRecaptchaMessage=$event.detail.show"
                        x-show="showRecaptchaMessage" class="block justify-center space-y-2">
                        <p class="font-semibold text-center text-red-500 dark:text-red-400">Gagal verifikasi reCAPTCHA
                        </p>
                        <a href="{{route('kosadata.form-internet-desa.index')}}" :disabled="disabledButton"
                            wire:loading.attr="disabled"
                            x-on:disabling-button.window="disabledButton = $event.detail.params"
                            class="w-full flex justify-center items-center py-4 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-gray-400 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-300 transform disabled:bg-gray-400 hover:scale-[1.02] active:scale-[0.98]">
                            <span class="font-semibold tracking-wider text-white">
                                Refresh Halaman
                            </span>
                        </a>
                    </div>

                    {{-- <!-- Submit Button --> --}}
                    <button type="submit" :disabled="disabledButton" wire:loading.attr="disabled"
                        x-on:disabling-button.window="disabledButton = $event.detail.params"
                        class="w-full flex justify-center items-center py-4 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-emerald-500 hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-300 transform disabled:bg-gray-400 hover:scale-[1.02] active:scale-[0.98]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="mr-2 lucide lucide-send-icon lucide-send">
                            <path
                                d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z" />
                            <path d="m21.854 2.147-10.94 10.939" />
                        </svg>
                        <span class="font-semibold tracking-wider text-white">Kirim</span>
                    </button>

                </form>

                {{-- success card --}}
                <div class="space-y-6 text-center" x-show="isSend" x-transition.duration.500ms x-transition.opacity>
                    <div class="flex items-center justify-center">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="text-center lucide lucide-circle-check-big-icon lucide-circle-check-big text-emerald-400">
                                <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                <path d="m9 11 3 3L22 4" />
                            </svg>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <p class="text-lg font-semibold text-gray-600 dark:text-white">
                            Data Penyedia Internet Desa Telah Tersimpan
                        </p>
                        <p class="text-lg font-semibold text-gray-600 dark:text-white">
                            Terima Kasih telah mengisi formulir ini.
                        </p>
                    </div>

                    <div
                        class="flex items-center py-3 text-xs text-gray-400 uppercase before:flex-1 before:border-t before:border-gray-200 before:me-6 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-neutral-500 dark:before:border-neutral-600 dark:after:border-neutral-600">
                        atau
                    </div>

                    <div class="">
                        <a href="/form-internet-desa" wire:navigate.hover class="font-semibold text-emerald-500">
                            Tambah data baru
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>