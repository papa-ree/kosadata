<?php

namespace Nawasara\Kosadata\Livewire\LandingPages\FormInternetDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\{Computed, Layout, Title, Validate};
use Nawasara\Kosadata\Models\Desa;
use Nawasara\Kosadata\Models\InternetProvider;
use Nawasara\Kosadata\Models\IspDesa;
use Nawasara\Kosadata\Models\Kecamatan;
use Illuminate\Support\Facades\Validator;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;
use Nawasara\Kosadata\Rules\ActiveWhatsapp;
use Nawasara\Wago\Services\WagoService;

#[Layout('kosadata::layouts.guest')]
#[Title('Form Internet Desa')]
class Index extends Component
{
    public $name;
    public $new_provider_name;
    public $contact_name;
    public $contact_phone;
    public $user_name;
    public $user_phone;
    public $user_job;
    public $kecamatan_id;
    public $desa_id;
    public $desas = [];
    public $sended = false;
    public $availableKecamatans;
    public $desaByKecamatan;
    public $recaptchaToken = '';
    public string $normalized_user_phone = '';
    public string $normalized_contact_phone = '';

    public function mount()
    {
        $this->availableKecamatans = Kecamatan::select('id', 'name')->orderBy('name')->get();

        $this->desaByKecamatan = Desa::query()
            ->get()
            ->groupBy('kecamatan_id')
            ->map(fn($items) => $items->map(fn($d) => [
                'id' => (string) $d->id,
                'name' => $d->name,
            ]))
            ->toArray();
    }

    public function render()
    {

        return view('kosadata::livewire.landing-pages.form-internet-desa.index');
    }

    #[Computed]
    public function availableProviders()
    {
        return InternetProvider::orderBy('name')->get();
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:70',
            'new_provider_name' => 'required_if:name,other|max:70',

            'contact_name' => 'required|string|max:70',
            'contact_phone' => [
                'required',
                'string',
                'max:16',
                new ActiveWhatsapp(config('kosadata.whatsapp_user_verification')),
            ],

            'user_name' => 'required|string|max:70',
            'user_phone' => [
                'required',
                'string',
                'max:16',
                new ActiveWhatsapp(config('kosadata.whatsapp_user_verification')),
            ],

            'user_job' => 'required|string|max:70',
            'kecamatan_id' => 'required|uuid|exists:kecamatans,id',
            'desa_id' => 'required|uuid|exists:desas,id',
        ];
    }


    protected function messages()
    {
        return [
            'name.required' => 'Penyedia Internet wajib dipilih',
            'name.string' => 'Gunakan karakter',
            'name.max' => 'Maksimal 70 karakter',
            'new_provider_name.required_if' => 'Nama Penyedia Internet wajib diisi',
            'new_provider_name.string' => 'Gunakan karakter',
            'new_provider_name.max' => 'Maksimal 70 karakter',
            'contact_name.required' => 'Nama Kontak Provider Internet wajib diisi',
            'contact_name.string' => 'Gunakan karakter',
            'contact_name.max' => 'Maksimal 70 karakter',
            'contact_phone.required' => 'Nomor HP Kontak Provider Internet wajib diisi',
            'contact_phone.string' => 'Gunakan karakter',
            'contact_phone.max' => 'Maksimal 16 karakter',
            'user_name.required' => 'Nama Petugas Desa wajib diisi',
            'user_name.string' => 'Gunakan karakter',
            'user_name.max' => 'Maksimal 70 karakter',
            'user_phone.required' => 'Nomor HP wajib diisi',
            'user_phone.string' => 'Gunakan karakter',
            'user_phone.max' => 'Maksimal 16 karakter',
            'user_job.required' => 'Jabatan Petugas Desa wajib diisi',
            'user_job.string' => 'Gunakan karakter',
            'user_job.max' => 'Maksimal 70 karakter',
            'kecamatan_id.required' => 'Kecamatan wajib dipilih',
            'desa_id.required' => 'Desa wajib dipilih',

        ];
    }

    public function store()
    {
        $this->resetErrorBag();

        $validated = $this->validate();

        $score = RecaptchaV3::verify($this->recaptchaToken, 'store');

        if (!$score || $score < 0.5) {
            $this->dispatch('toast', message: 'Silahkan Refresh Halaman Ini', type: 'error');
            $this->dispatch('toast', message: 'Gagal Verifikasi reCAPTCHA', type: 'error');
            $this->dispatch('show-recaptcha-message', show: true);
            return;
        }

        DB::transaction(function () use ($validated) {

            $providerName = $validated['name'] === 'other'
                ? $validated['new_provider_name']
                : $validated['name'];

            $provider = InternetProvider::firstOrCreate([
                'name' => $providerName,
            ]);

            IspDesa::create([
                'internet_provider_id' => $provider->id,
                'contact_name' => $validated['contact_name'],
                'contact_phone' => $this->normalizePhone($validated['contact_phone']),
                'user_name' => $validated['user_name'],
                'user_phone' => $this->normalizePhone($validated['user_phone']),
                'user_job' => $validated['user_job'],
                'kecamatan_id' => $validated['kecamatan_id'],
                'desa_id' => $validated['desa_id'],
            ]);
        });

        $this->sended = true;
    }


    protected function normalizePhone(string $phone): string
    {
        $phone = preg_replace('/\D/', '', $phone);

        if (str_starts_with($phone, '08')) {
            return '62' . substr($phone, 1);
        }

        if (str_starts_with($phone, '8')) {
            return '62' . $phone;
        }

        return $phone;

    }
}