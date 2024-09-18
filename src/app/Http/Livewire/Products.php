<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class Products extends Component
{
    public $searchTerm = '';
    public $viewType = 'new';
    public $newItems;
    public $likedItems;
    public $message = '';

    protected $listeners = ['searchUpdated' => 'updateSearchTerm'];

    public function mount()
    {
        $this->loadItems();
    }


    public function updateSearchTerm($term)
    {
        $this->searchTerm = $term;
        $this->loadItems();
    }


    public function showNew()
    {
        $this->viewType = 'new';
        $this->loadItems();
    }


    public function showLiked()
    {
        if (!Auth::check()) {
            $this->message = 'ログインまたは会員登録が必要です。';
            $this->likedItems = collect();
        } else {
        $this->viewType = 'liked';
        $this->loadItems();
        }
    }


    private function loadItems()
    {
        $query = Item::query();

        if (!empty($this->searchTerm)) {
            $query->where('name', 'like', '%' . $this->searchTerm . '%');
        }

        $query->whereDoesntHave('purchasers');

        if ($this->viewType === 'new') {
            $this->newItems = $query->orderBy('created_at', 'desc')->get();
            $this->likedItems = collect();
        } else {
            if (Auth::check()) {
            $this->likedItems = auth()->user()->likedItems;
            } else {
                $this->likedItems = collect();
            }
            $this->newItems = collect();
        }
    }


    public function render()
    {
        return view('livewire.products', [
            'items' => $this->viewType === 'new' ? $this->newItems : $this->likedItems,
            'message' => $this->message,
        ]);
    }

}
