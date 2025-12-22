<?php

namespace Nawasara\Kosadata\Livewire\Pages\InternetProvider\Section;

use Bale\Core\Traits\HasDeleteOption;
use Livewire\Component;
use Livewire\Attributes\{Computed, Layout};
use Livewire\WithPagination;
use Nawasara\Kosadata\Models\InternetProvider;

#[Layout('rakaca::layouts.app')]
class InternetProviderTable extends Component
{
    use HasDeleteOption, WithPagination;
    protected string $modelClass = InternetProvider::class;

    public $query = '';

    public function render()
    {
        return view('kosadata::livewire.pages.internet-provider.section.internet-provider-table');
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
    public function availableInternetProviders()
    {
        return InternetProvider::orderBy('name')->where('name', 'like', "%{$this->query}%")->select(['id', 'name', 'created_at'])->paginate(100);
    }
}