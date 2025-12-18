<?php

namespace Nawasara\Kosadata\Livewire\Pages\InternetProvider;

use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('rakaca::layouts.app')]
#[Title('Rakaca | Internet Provider')]
class Index extends Component
{
    public function render()
    {
        return view('kosadata::livewire.pages.internet-provider.index');
    }
}