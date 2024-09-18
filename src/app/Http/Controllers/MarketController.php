<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SellRequest;
use App\Models\Condition;

class MarketController extends Controller
{
    public function index()
    {
        $items = Item::with('categories','condition')
        ->whereDoesntHave('purchasers')
        ->get();
        return view('index',compact('items'));
    }


    public function showDetail($id)
    {
        $item = Item::with('categories')->find($id);
        return view('detail',compact('item'));
    }


    public function showSell()
    {
        $conditions = Condition::all();
        return view('sell',compact('conditions'));
    }


    public function store(SellRequest $request)
    {
        $item = new Item();
        $item->user_id = Auth::id();
        $item->name = $request->input('name');

        if ($request->hasFile('item_image')) {
            $image = $request->file('item_image');
            $imagePath = $image->store('images', 'public');
            $item->item_image = $imagePath;
        } else {
            $item->item_image = null;
        }

        $item->price = $request->input('price');
        $item->description = $request->input('description');
        $item->condition_id = $request->input('condition_id');
        $item->save();

        $categoryIds = $request->input('category_id', []);
        $item->categories()->attach($categoryIds);

        return redirect()->route('index')->with('message','商品を出品しました');
    }

}
