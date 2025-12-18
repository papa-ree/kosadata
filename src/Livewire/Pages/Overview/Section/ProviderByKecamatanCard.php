<?php

namespace Nawasara\Kosadata\Livewire\Pages\Overview\Section;

use Livewire\Component;
use Livewire\Attributes\{Computed, Layout};
use Nawasara\Kosadata\Models\IspDesa;
use Nawasara\Kosadata\Models\Kecamatan;

#[Layout('rakaca::layouts.app')]
class ProviderByKecamatanCard extends Component
{
    public function render()
    {
        return view('kosadata::livewire.pages.overview.section.provider-by-kecamatan-card');
    }

    #[Computed]
    public function kecamatanProviderCount()
    {
        return IspDesa::query()
            ->selectRaw('kecamatan_id, COUNT(DISTINCT internet_provider_id) as total_provider')
            ->with('kecamatan')
            ->groupBy('kecamatan_id')
            ->join('kecamatans', 'kecamatans.id', '=', 'isp_desas.kecamatan_id')
            ->orderBy('kecamatans.name', 'asc')
            ->get();
    }

}