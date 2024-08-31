<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;

class DetailPage extends Component
{
    public $searchTerm = '';
    public $items = [];
    public $item; // アイテムの詳細情報

    protected $listeners = ['searchUpdated' => 'updateSearchTerm'];

    public function mount($itemId)
    {
        $this->itemId = $itemId;
        $this->item = Item::with('categories')->findOrFail($itemId);
        $this->commentCount = $this->item->comments()->count();
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
        return view('livewire.detail-page', [
            'items' => $this->items,
            'itemDetails' => $this->item,
            'commentCount' => $this->commentCount,
        ]);
    }
}

