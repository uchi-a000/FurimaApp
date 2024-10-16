<?php

namespace App\Http\Controllers;

use App\Models\CategoryItem;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('index', compact('items'));
    }

    public function itemDetail($id)
    {
        $user_id = Auth::id();
        $item = Item::with('condition')->find($id);
        $category_items = CategoryItem::where('item_id', $item->id)->with('category')->get();

        return view('item_detail', compact('item', 'category_items'));
    }
}
