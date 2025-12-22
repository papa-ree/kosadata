<?php

namespace Nawasara\Kosadata\Livewire\LandingPages\FormInternetDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\{Computed, Layout, Title, Validate};
use Nawasara\Kosadata\Models\Desa;
use Nawasara\Kosadata\Models\InternetProvider;
use Nawasara\Kosadata\Models\IspDesa;
use Nawasara\Kosadata\Models\Kecamatan;
use DutchCodingCompany\LivewireRecaptcha\ValidatesRecaptcha;
use Illuminate\Support\Facades\Validator;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;

#[Layout('kosadata::layouts.guest')]
#[Title('Form Internet Desa')]
class Index extends Component
{
    public $name;
    public $new_provider_name;
    public $contact_name;
    public $contact_phone;
    public $user_name;
    public $user_job;
    public $kecamatan_id;
    public $desa_id;

    public $desas = [];

    public $showAddProviderInput = false;
    public $sended = false;

    public $availableKecamatans;
    public $desaByKecamatan;
    public $recaptcha;

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

    protected function rules()
    {
        return [
            'name' => 'required|string|max:70',
            'new_provider_name' => 'max:70|required_if:name,other',
            'contact_name' => 'required|string|max:70',
            'contact_phone' => 'required|string|max:16',
            'user_name' => 'required|string|max:70',
            'user_job' => 'required|string|max:70',
            'kecamatan_id' => 'required|uuid|exists:kecamatans,id',
            'desa_id' => 'required|uuid|exists:desas,id',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Nama Provider Internet wajib diisi',
            'name.string' => 'Gunakan karakter',
            'name.max' => 'Maksimal 70 karakter',
            'new_provider_name.required_if' => 'Nama Provider Internet wajib diisi',
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
            'user_job.required' => 'Jabatan Petugas Desa wajib diisi',
            'user_job.string' => 'Gunakan karakter',
            'user_job.max' => 'Maksimal 70 karakter',
            'kecamatan_id.required' => 'Kecamatan wajib dipilih',
            'desa_id.required' => 'Desa wajib dipilih',

        ];
    }

    public function store($input)
    {
        $this->recaptcha = $input['g-recaptcha-response'];

        $score = RecaptchaV3::verify($input['g-recaptcha-response'], 'store');

        if ($score < 0.9) {
            $this->dispatch('toast', message: 'Silahkan Refresh Halaman Ini', type: 'error');
            $this->dispatch('toast', message: 'Gagal Verifikasi reCAPTCHA', type: 'error');
            $this->dispatch('show-recaptcha-message', show: true);
            return;
        }

        $this->validate();

        DB::beginTransaction();

        try {
            $provider_name = $this->name == "other" ? $this->new_provider_name : $this->name;

            $provider = InternetProvider::updateOrCreate(
                [
                    'name' => $provider_name,
                ],
                []
            );

            $this->storeProviderDesa($provider->id);

            DB::commit();
            $this->sended = true;

        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('disabling-button', params: false);
            info('Add Internet Desa Form failed: ' . $th->getMessage());
            $this->dispatch('toast', message: 'Something Wrong!', type: 'error');
        }
    }

    protected function convertPhoneToWhatsApp($phoneNumber)
    {
        // Hapus semua karakter non-digit
        $cleaned = preg_replace('/\D/', '', $phoneNumber);

        // Jika diawali dengan '08', ganti dengan '628'
        if (substr($cleaned, 0, 2) === '08') {
            return '62' . substr($cleaned, 1);
        }

        // Jika sudah diawali dengan '62', biarkan as is
        if (substr($cleaned, 0, 2) === '62') {
            return $cleaned;
        }

        // Jika diawali dengan '8', tambahkan '62'
        if (substr($cleaned, 0, 1) === '8') {
            return '62' . $cleaned;
        }

        // Untuk format lainnya, return yang sudah dibersihkan
        return $cleaned;
    }

    protected function storeProviderDesa($provider_id)
    {
        $convert_phone = $this->convertPhoneToWhatsApp($this->contact_phone);

        IspDesa::create([
            'internet_provider_id' => $provider_id,
            'contact_name' => $this->contact_name,
            'contact_phone' => $convert_phone,
            'user_name' => $this->user_name,
            'user_job' => $this->user_job,
            'kecamatan_id' => $this->kecamatan_id,
            'desa_id' => $this->desa_id,
        ]);
    }
}