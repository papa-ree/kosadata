<?php

namespace Nawasara\Kosadata\Livewire\Pages\InternetProvider\Section;

use Bale\Core\Traits\HasDeleteOption;
use Livewire\Component;
use Livewire\Attributes\{Computed, Layout};
use Nawasara\Kosadata\Models\InternetProvider;

#[Layout('rakaca::layouts.app')]
class InternetProviderTable extends Component
{
    use HasDeleteOption;
    protected string $modelClass = InternetProvider::class;

    public $query = '';

    public function render()
    {
        return view('kosadata::livewire.pages.internet-provider.section.internet-provider-table');
    }

    #[Computed]
    public function availableInternetProviders()
    {
        return InternetProvider::orderBy('name')->select(['id', 'name', 'created_at'])->paginate(100);
    }
}