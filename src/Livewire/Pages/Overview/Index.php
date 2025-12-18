<?php

namespace Nawasara\Kosadata\Livewire\Pages\Overview;

use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('rakaca::layouts.app')]
#[Title('Rakaca | Internet Desa Overview')]
class Index extends Component
{
    public function render()
    {
        return view('kosadata::livewire.pages.overview.index');
    }
}