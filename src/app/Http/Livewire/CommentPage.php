<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class CommentPage extends Component
{
    public $searchTerm = '';
    public $items = [];
    public $itemId;
    public $item;
    public $user;
    public $commentCount;

    protected $listeners = ['searchUpdated' => 'updateSearchTerm'];

    public function mount($itemId)
    {
        $this->itemId = $itemId;
        $this->item = Item::findOrFail($itemId);
        $this->user = Auth::user();
    }


    public function updateSearchTerm($value)
    {
        $this->searchTerm = $value;
        $this->items = !empty($value)
            ? Item::where('name', 'like', '%' . $value . '%')->get()
            : [];
        $this->user = Auth::user();
    }


    public function render()
    {
        $comments = Comment::where('item_id', $this->itemId)
            ->with('user')
            ->paginate(3);
        return view('livewire.comment-page', [
            'items' => !empty($this->searchTerm)
                ? Item::where('name', 'like', '%' . $this->searchTerm . '%')->get()
                : [],
            'item' => $this->item,
            'user' => $this->user,
            'commentCount' => $this->commentCount,
            'comments' => $comments,
        ]);
    }
}
