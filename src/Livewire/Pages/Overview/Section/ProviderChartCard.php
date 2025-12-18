<?php

namespace Nawasara\Kosadata\Livewire\Pages\Overview\Section;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\{Computed, Layout};
use Nawasara\Kosadata\Models\InternetProvider;
use Nawasara\Kosadata\Models\IspDesa;

#[Layout('rakaca::layouts.app')]
class ProviderChartCard extends Component
{
    public function render()
    {
        return view('kosadata::livewire.pages.overview.section.provider-chart-card');
    }

    #[Computed]
    public function availableProviders()
    {
        $providers = IspDesa::query()
            ->select('internet_provider_id', DB::raw('COUNT(*) as total'))
            ->groupBy('internet_provider_id')
            ->orderBy('total', 'desc')
            ->get();
        ;
        // dd(json_encode($providers->pluck('name')));
        return $providers;
    }
}