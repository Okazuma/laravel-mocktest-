<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function showComment($id)
    {
        $user = Auth::user();
        $item = Item::find($id);
        $comments = $item->comments()->with('user')->get();
        return view('comment',compact('user','item','comments'));
    }


    public function comment(Request $request,$itemId)
    {
        Comment::create([
            'item_id' => $itemId,
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);
            return redirect()->back()->with('message','コメントを追加しました');
    }


    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
            if ($comment->user_id !== auth()->id()) {
                return redirect()->back()->with('error', '権限がありません');
            }
        $comment->delete();
        return redirect()->back()->with('success', 'コメントが削除されました');
    }
}
