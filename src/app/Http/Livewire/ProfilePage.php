<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;

class ProfilePage extends Component
{
    public $searchTerm = '';
    public $items = [];
    public $user;

    protected $listeners = ['searchUpdated' => 'updateSearchTerm'];

    public function mount()
    {
        $this->user = auth()->user();
    }


    public function updateSearchTerm($value)
    {
        $this->searchTerm = $value;
        $this->items = !empty($value)
            ? Item::where('name', 'like', '%' . $value . '%')->get()
            : [];
    }

    public function render()
    {
        return view('livewire.profile-page', [
            'items' => $this->items,
            'user' => $this->user,
        ]);
    }
}
