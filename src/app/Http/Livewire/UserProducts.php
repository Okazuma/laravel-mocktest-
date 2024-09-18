<?php

namespace App\Http\Livewire;


use Livewire\Component;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class UserProducts extends Component
{

    public $viewType = 'selling';
    public $sellingItems = [];
    public $boughtItems = [];


    public function mount()
    {
        $user_id = Auth::id();

        $this->sellingItems = Item::where('user_id', $user_id)
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        $this->boughtItems = Item::whereIn('id', function ($query) use ($user_id) {
            $query->select('item_id')
                ->from('purchases')
                ->where('user_id', $user_id);
        })->get();
    }


    public function showSelling()
    {
        $this->viewType = 'selling';
    }


    public function showBought()
    {
        $this->viewType = 'bought';
    }


    public function render()
    {
        return view('livewire.user-products', [
            'sellingItems' => $this->sellingItems,
            'boughtItems' => $this->boughtItems,
        ]);
    }
}
