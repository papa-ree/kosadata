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
    public $desa_total_count;
    public $desa_with_data_count;
    public $desa_no_data;
    public $progress_percentage = 0;

    public function mount()
    {
        $this->internet_desa_count = IspDesa::count();

        $this->desa_total_count = Desa::count();

        $this->desa_with_data_count = Desa::has('ispDesas')->count();

        $this->desa_no_data = $this->desa_total_count - $this->desa_with_data_count;

        if ($this->desa_total_count > 0) {
            $this->progress_percentage = ($this->desa_with_data_count / $this->desa_total_count) * 100;
        } else {
            $this->progress_percentage = 0;
        }
    }

    public function render()
    {
        return view('kosadata::livewire.pages.overview.section.internet-desa-input-card');
    }
}