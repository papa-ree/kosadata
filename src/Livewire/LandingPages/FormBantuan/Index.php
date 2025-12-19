<?php

namespace Nawasara\Kosadata\Livewire\LandingPages\FormBantuan;

use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('kosadata::layouts.guest')]
#[Title('Form Bantuan')]
class Index extends Component
{
    public function render()
    {
        return view('kosadata::livewire.landing-pages.form-bantuan.index');
    }
}