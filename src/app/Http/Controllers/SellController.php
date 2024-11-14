<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Support\Facades\Auth;

class SellController extends Controller
{

    public function sell(Request $request)
    {
        $user = Auth::user();
        $items = Item::where('user_id', $user->id)->get();
        $categories = Category::all();
        $conditions = Condition::all();

        return view('sell', compact('items', 'categories', 'conditions'));
    }

    public function store(Request $request)
    {

        if ($request->hasFile('item_img_1')) {
            $item_img_1 = $request->file('item_img_1')->store('images', 'public');
        }

        $item = Item::create([
            'user_id' => auth()->id(),
            'condition_id' => $request->condition_id,
            'item_name' => $request->item_name,
            'price' => $request->price,
            'description' => $request->description,
            'item_img_1' => $item_img_1,
        ]);

        $item->categories()->attach($request->category_item_ids);

        return redirect()->back()->with('message', '商品を登録しました');
    }

}
