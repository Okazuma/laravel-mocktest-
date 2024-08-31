<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ItemSearch extends Component
{

    public $searchTerm = '';

    public function updatedSearchTerm($value)
    {
        $this->emit('searchUpdated', $value);
    }


    public function render()
    {
        return view('livewire.item-search');
    }
}
