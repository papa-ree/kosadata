<?php

namespace Nawasara\Kosadata\Livewire\Pages\IspDesa\Section;

use Bale\Core\Traits\HasDeleteOption;
use Livewire\Component;
use Livewire\Attributes\{Computed, Layout, On};
use Livewire\WithPagination;
use Nawasara\Kosadata\Models\IspDesa;

#[Layout('rakaca::layouts.app')]
class IspDesaTable extends Component
{
    use HasDeleteOption, WithPagination;

    protected string $modelClass = IspDesa::class;

    public $query = '';

    #[On('refresh-isp-desa')]
    public function render()
    {
        return view('kosadata::livewire.pages.isp-desa.section.isp-desa-table');
    }

    public function updating($key): void
    {
        if ($key === 'query') {
            $this->resetPage();
        }
    }

    public function updatedPage()
    {
        $this->dispatch('paginated');
    }

    #[Computed]
    public function availableIspDesas()
    {
        return IspDesa::query()
            ->with(['provider', 'kecamatan', 'desa'])
            ->search($this->query)
            ->orderByKecamatanName()
            ->paginate(10);
    }
}