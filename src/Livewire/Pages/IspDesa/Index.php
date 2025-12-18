<?php

namespace Nawasara\Kosadata\Livewire\Pages\IspDesa;

use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('rakaca::layouts.app')]
#[Title('Rakaca | Internet Desa')]
class Index extends Component
{
    public function render()
    {
        return view('kosadata::livewire.pages.isp-desa.index');
    }
}