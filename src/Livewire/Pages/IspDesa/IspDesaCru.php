<?php

namespace Nawasara\Kosadata\Livewire\Pages\IspDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\{Computed, Layout, Title, Validate};
use Nawasara\Kosadata\Models\InternetProvider;
use Nawasara\Kosadata\Models\IspDesa;

#[Layout('rakaca::layouts.app')]
#[Title('Rakaca | Internet Desa Form')]
class IspDesaCru extends Component
{
    public IspDesa $desa;

    #[Validate('required')]
    public $internet_provider_id;

    #[Validate('required|max:70')]
    public $contact_name;

    #[Validate('required|max:16')]
    public $contact_phone;

    #[Validate('required|max:70')]
    public $user_name;

    #[Validate('required|max:70')]
    public $user_job;
    public $editMode = false;

    public function mount(IspDesa $desa)
    {
        if ($desa->exists) {
            $this->internet_provider_id = $desa->internet_provider_id;
            $this->contact_name = $desa->contact_name;
            $this->contact_phone = $desa->contact_phone;
            $this->user_name = $desa->user_name;
            $this->user_job = $desa->user_job;
            $this->editMode = true;
        }
    }

    public function render()
    {
        return view('kosadata::livewire.pages.isp-desa.isp-desa-cru');
    }

    #[Computed]
    public function availableProviders()
    {
        return InternetProvider::orderBy('name')->get();
    }

    public function store()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $this->dispatch('disabling-button', params: true);

            IspDesa::create([
                'internet_provider_id' => $this->internet_provider_id,
                'contact_name' => $this->contact_name,
                'contact_phone' => $this->contact_phone,
                'user_name' => $this->user_name,
                'user_job' => $this->user_job,
            ]);

            DB::commit();

            session()->flash('success', 'Data Provider Desa Added!');

            $this->redirectRoute('kosadata.isp-desa.index', navigate: true);

        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('disabling-button', params: false);
            info('Create Internet Desa failed: ' . $th->getMessage());
            $this->dispatch('toast', message: 'Something Wrong!', type: 'error');
        }
    }

    public function update()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $this->dispatch('disabling-button', params: true);

            $this->desa->update([
                'internet_provider_id' => $this->internet_provider_id,
                'contact_name' => $this->contact_name,
                'contact_phone' => $this->contact_phone,
                'user_name' => $this->user_name,
                'user_job' => $this->user_job,
            ]);

            DB::commit();

            session()->flash('success', 'Data Provider Desa Updated!');

            $this->redirectRoute('kosadata.isp-desa.index', navigate: true);

        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('disabling-button', params: false);
            info('Update Internet Desa failed: ' . $th->getMessage());
            $this->dispatch('toast', message: 'Something Wrong!', type: 'error');
        }
    }
}