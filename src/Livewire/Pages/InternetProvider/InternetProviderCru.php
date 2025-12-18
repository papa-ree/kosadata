<?php

namespace Nawasara\Kosadata\Livewire\Pages\InternetProvider;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title, Validate};
use Nawasara\Kosadata\Models\InternetProvider;

#[Layout('rakaca::layouts.app')]
#[Title('Rakaca | Internet Provider Form')]
class InternetProviderCru extends Component
{
    public InternetProvider $isp;

    #[Validate('required|max:70')]
    public $name;

    #[Validate('max:255')]
    public $description;

    public $editMode = false;
    public function mount(InternetProvider $isp)
    {
        if ($isp->exists) {
            $this->name = $isp->name;
            $this->description = $isp->description;
            $this->editMode = true;
        }
    }

    public function render()
    {
        return view('kosadata::livewire.pages.internet-provider.internet-provider-cru');
    }

    public function store()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $this->dispatch('disabling-button', params: true);

            InternetProvider::create([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            DB::commit();

            session()->flash('success', 'Internet Provider Added!');

            $this->redirectRoute('kosadata.internet-provider.index', navigate: true);

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

            $this->isp->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            DB::commit();

            session()->flash('success', 'Internet Provider Updated!');

            $this->redirectRoute('kosadata.internet-provider.index', navigate: true);

        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('disabling-button', params: false);
            info('Update Internet Desa failed: ' . $th->getMessage());
            $this->dispatch('toast', message: 'Something Wrong!', type: 'error');
        }
    }
}