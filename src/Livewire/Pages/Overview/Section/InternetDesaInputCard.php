<?php

namespace Nawasara\Kosadata\Livewire\Pages\Overview\Section;

use Livewire\Component;
use Livewire\Attributes\{Layout};
use Nawasara\Kosadata\Models\Desa;
use Nawasara\Kosadata\Models\InternetProvider;
use Nawasara\Kosadata\Models\IspDesa;

#[Layout('rakaca::layouts.app')]
class InternetDesaInputCard extends Component
{
    public $internet_desa_count;
    public $desa_no_data;

    public function mount()
    {
        $this->internet_desa_count = IspDesa::get()->count();

        $this->desa_no_data = Desa::query()
            ->leftJoin('isp_desas', 'isp_desas.desa_id', '=', 'desas.id')
            ->whereNull('isp_desas.id')
            ->count();
        ;
    }

    public function render()
    {
        return view('kosadata::livewire.pages.overview.section.internet-desa-input-card');
    }
}