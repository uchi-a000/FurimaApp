<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $category = $request->input('category');
        $categories = Category::all();

        $items = Item::query()
                ->when($keyword, function ($query, $keyword) {
                    return $query->where('item_name', 'like', "%{$keyword}%");
                })
                ->get();

        return view('index', compact('keyword', 'category', 'categories', 'items'));

    }

    public function itemDetail($id)
    {

        $item = Item::with('condition')->find($id);
        $category_items = CategoryItem::where('item_id', $item->id)->with('category')->get();

        return view('item_detail', compact('item', 'category_items'));
    }

    public function comment($id)
    {
        $user = Auth::user();
        $item = Item::find($id);
        $comments = Comment::where('item_id', $id)
                            ->with('user.profile')
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
