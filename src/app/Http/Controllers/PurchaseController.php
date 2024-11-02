<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Profile;
use App\Models\SoldItem;
use Illuminate\Support\Facades\Auth;


class PurchaseController extends Controller
{
    public function purchase($id)
    {

        $item = Item::find($id);

        return view('purchase', compact('item'));
    }

    public function store(Request $request)
    {
        Item::find($request->item_id);

        SoldItem::create([
            'user_id' => auth()->id(),
            'item_id' => $request->item_id,
        ]);

        return redirect()->back()->with('message', '購入しました');
    }

    public function show()
    {

        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();

        return view('purchase_address', compact('profile'));
    }

    public function update(Request $request)
    {

        $profile = Profile::find($request->id);

        $profile_data = $request->only(['postcode', 'address', 'building']);
        $profile->update($profile_data);

        return redirect()->back()->with('message', '住所の変更をしました');
    }


}
