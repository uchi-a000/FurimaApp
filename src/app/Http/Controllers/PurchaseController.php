<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\SoldItem;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;


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


    public function showPayment($id)
    {

        $item = Item::find($id);

        return view('stripe.payment', compact('item'));
    }

    public function checkout(Request $request)
    {

        Stripe::setApiKey(config('services.stripe.secret'));

        $item = Item::find($request->input('item_id'));

        try {
            // 金額を整数に変換
            $amount = intval($item->price);

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => [
                            'name' => $item['item_name'],
                        ],
                        'unit_amount' => $amount,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('stripe.success', $item->id),
                'cancel_url' => route('stripe.cancel', $item->id),
            ]);

            return redirect($session->url);
        } catch (\Exception $e) {
            return redirect()->route('stripe.payment_form', $item->id)->with('error', '決済に失敗しました。もう一度お試しください.
            ' . $e->getMessage());
        }
    }

}
