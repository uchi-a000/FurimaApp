<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryItem;
use App\Models\Comment;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('index', compact('items'));
    }

    public function search(Request $request)
    {
        $keyword = $request['keyword'];

        $searchResult = Item::searchItems($keyword);
        $items = $searchResult['items'];
        $text = "「" . $searchResult['text'] . "」の検索結果";

        session()->flash('fs_msg', $text);
        return view('index', compact("items", "text"));
    }

    public function itemDetail($id)
    {
        $user_id = Auth::id();
        $item = Item::with('condition')->find($id);
        $category_items = CategoryItem::where('item_id', $item->id)->with('category')->get();

        return view('item_detail', compact('item', 'category_items'));
    }

    public function comment($id)
    {
        $item = Item::find($id);

        return view('comment', compact('item'));
    }

    public function store(Request $request)
    {

        $item = Item::find($request->item->id);

        Comment::create([
            'user_id' => auth()->id(),
            'item_id' => $request->item_id,
            'comment' => $request->comment,
        ]);

        return redirect()->back();
    }
}
