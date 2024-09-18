<?php

namespace App\Http\Livewire;


use Livewire\Component;
use App\Models\Item;

class Mypage extends Component
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
        $this->items = $this->searchTerm
        ? Item::where('name','like','%'.$this->searchTerm .'%')->get()
        : [];
    }


    public function render()
    {
        return view('livewire.mypage',[
            'items' => $this->items,
            'user' => $this->user,
        ]);
    }
}
