<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\SoldItem;
use Illuminate\Support\Facades\Auth;


class PurchaseController extends Controller
{
    public function purchase($id)
    {
        $item = Item::find($id);
        $user = Auth::user();
        $payment = $user->profile->payment;

        return view('purchase', compact('item', 'payment'));
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

    public function addressShow()
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();

        return view('purchase_address', compact('profile'));
    }

    public function addressUpdate(Request $request)
    {

        $profile = Profile::find($request->id);

        $profile_data = $request->only(['postcode', 'address', 'building']);
        $profile->update($profile_data);

        return redirect()->back()->with('message', '住所の変更をしました');
    }


    public function paymentMethodShow()
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();
        $payments = Payment::all();

        return view('purchase_payment_method', compact('profile', 'payments'));
    }


    public function paymentMethodUpdate(Request $request)
    {
        $profile = Profile::find($request->id);

        $profile_data = $request->only(['payment_id']);
        $profile->update($profile_data);

        return redirect()->back()->with('message', 'お支払い方法の変更をしました');
    }


}
