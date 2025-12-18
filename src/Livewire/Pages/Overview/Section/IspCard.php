<?php

namespace Nawasara\Kosadata\Livewire\Pages\Overview\Section;

use Livewire\Component;
use Livewire\Attributes\{Layout};
use Nawasara\Kosadata\Models\InternetProvider;

#[Layout('rakaca::layouts.app')]
class IspCard extends Component
{
    public $internet_provider_count;

    public function mount()
    {
        $this->internet_provider_count = InternetProvider::get()->count();
    }

    public function render()
    {
        return view('kosadata::livewire.pages.overview.section.isp-card');
    }
}