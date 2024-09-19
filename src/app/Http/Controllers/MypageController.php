<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileRequest;

class MypageController extends Controller
{
    public function showMypage()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $sellingItems = Item::where('user_id',$user_id)->get();
        $boughtItems = Item::whereIn('id', function ($query) use ($user_id) {
        $query->select('item_id')
            ->from('purchases')
            ->where('user_id', $user_id);
        })->get();

        return view('mypage',compact('user','sellingItems','boughtItems','user_id'));
    }


    public function showProfile($id)
    {
        $user = User::find($id);
        $searchTerm = request('searchTerm', '');
        return view('profile',compact('user','searchTerm'));
    }


    public function updateProfile(ProfileRequest $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->postal_code = $request->postal_code;
        $user->address = $request->address;
        $user->building = $request->building;

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image && Storage::disk(config('filesystems.default'))->exists($user->profile_image)) {
            Storage::disk(config('filesystems.default'))->delete($user->profile_image);
        }
            $filePath = $request->file('profile_image')->store('profile', config('filesystems.default'));
            $user->profile_image = $filePath;
        }
        $user->save();
        return redirect()->route('profile', ['id' => $user->id])->with('message', 'プロフィールを更新しました');
    }
}
