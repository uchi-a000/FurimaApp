<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class SellController extends Controller
{

    public function store(Request $request)
    {

        if($request->hasFile('item_img')) {
            $item_img = $request->file('item_img')->store('images', 'public');
        }

        // priceを数値に変換
        $price = str_replace(',', '', $request->price); // カンマを削除
        $price = (float) $price; // float型にキャスト

        $item = Item::create([
            'user_id' => auth()->id(),
            'condition_id' => $request->condition_id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'item_img' => $item_img,
        ]);

        $item->categories()->attach($request->category_item_ids);

        return redirect()->back()->with('message', '店舗情報を変更しました');
    }
}
