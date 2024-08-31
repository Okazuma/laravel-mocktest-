<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserNotification;

class AdminController extends Controller
{
    public function showDashboard()
    {
        return view('dashboard');
    }


    public function showDeleteUser()
    {
        $users = User::all();
        return view('delete-user',compact('users'));
    }


    public function deleteUser(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect()->route('admin.user')->with('message', 'ユーザーを削除しました。');
    }


    public function showDeleteComment()
    {
        $comments = Comment::all();
        return view('delete-comment',compact('comments'));
    }


    public function deleteComment(Request $request)
    {
        $commentId = $request->input('comment_id');
        $comment = Comment::findOrFail($commentId);
        $comment->delete();
        return redirect()->route('admin.comment')->with('message', 'コメントを削除しました。');
    }


    public function showMail()
    {
        return view('send-notification');
    }


    public function sendNotifyEmail(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        $subject = $request->input('subject');
        $message = $request->input('message');
        $users = User::all();
            foreach ($users as $user) {
            Mail::to($user->email)->send(new UserNotification($subject, $message));
            }
        return redirect()->route('admin.mail')->with('success', 'お知らせメールを送信しました。');
    }
}
