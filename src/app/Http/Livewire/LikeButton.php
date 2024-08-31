<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class LikeButton extends Component
{
    public $postId;
    public $liked = false;

    public function mount($itemId)
    {
        $this->itemId = $itemId;
        $this->liked = Like::where('item_id', $this->itemId)
                        ->where('user_id', Auth::id())
                        ->exists();
                        $this->likeCount = Like::where('item_id', $this->itemId)->count();
    }


    public function toggleLike()
    {
        if (!Auth::check()) {
            return redirect()->route('loginView');
        }
        if ($this->liked) {
            Like::where('item_id', $this->itemId)
                ->where('user_id', Auth::id())
                ->delete();
        } else {
            Like::create([
                'item_id' => $this->itemId,
                'user_id' => Auth::id(),
            ]);
        }
        $this->likeCount = Like::where('item_id', $this->itemId)->count();
        $this->liked = !$this->liked;
    }


    public function render()
    {
        return view('livewire.like-button');
    }
}
