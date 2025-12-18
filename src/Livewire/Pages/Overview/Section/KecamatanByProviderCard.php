<?php

namespace Nawasara\Kosadata\Livewire\Pages\Overview\Section;

use Livewire\Component;
use Livewire\Attributes\{Computed, Layout};
use Nawasara\Kosadata\Models\IspDesa;

#[Layout('rakaca::layouts.app')]
class KecamatanByProviderCard extends Component
{
    public function render()
    {
        return view('kosadata::livewire.pages.overview.section.kecamatan-by-provider-card');
    }

    #[Computed]
    public function providerKecamatanCount()
    {
        return IspDesa::query()
            ->selectRaw('internet_provider_id, COUNT(DISTINCT kecamatan_id) as total_kecamatan')
            ->with('provider')
            ->groupBy('internet_provider_id')
            ->join('internet_providers', 'internet_providers.id', '=', 'isp_desas.internet_provider_id')
            ->orderBy('internet_providers.name', 'asc')
            ->get();
    }
}