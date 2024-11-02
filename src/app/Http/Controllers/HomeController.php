<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryItem;
use App\Models\Comment;
use App\Models\Item;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('index', compact('items'));
    }

    public function myList()
    {
        $user = Auth::user();
        $favorites = Favorite::where('user_id', $user->id)->with('item')->get();

        return view('my_list', compact('favorites'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $items = Item::query()
                ->where('name', 'like', "%{$keyword}%")
                ->get();

        return view('index', compact('keyword', 'items'));

    }

    public function itemDetail($id)
    {

        $item = Item::with('condition')->find($id);
        $category_items = CategoryItem::where('item_id', $item->id)->with('category')->get();

        return view('item_detail', compact('item', 'category_items'));
    }

    public function comment($id)
    {
        $user_id = Auth::id();
        $item = Item::find($id);
        $comments = Comment::where('item_id', $id)
                            ->where('user_id', $user_id)
                            ->get();

        return view('comment', compact('item', 'comments'));
    }

    public function store(Request $request)
    {

        Item::find($request->item_id);

        Comment::create([
            'user_id' => auth()->id(),
            'item_id' => $request->item_id,
            'comment' => $request->comment,
        ]);

        return redirect()->back();
    }
}
