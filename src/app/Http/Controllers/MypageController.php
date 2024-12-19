<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\SoldItem;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;


class MypageController extends Controller
{
    public function myPagePurchase()
    {
        $user = Auth::user();
        $items = Item::where('user_id', $user->id)->get();
        $profile = Profile::where('user_id', $user->id)->first();

        return view('my_page_purchase', compact('items', 'profile'));
    }

    public function myPageSell()
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();
        $sold_items = SoldItem::where('user_id', $user->id)->with('item')->get();

        return view('my_page_sell', compact('profile', 'sold_items'));
    }


    public function profile()
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();
        $payments = Payment::all();

        return view('profile', compact('profile', 'payments'));
    }

    public function store(ProfileRequest $request)
    {
        $img_name = null;

        if($request->hasFile('img')){
            $img_path = $request->file('img')->store('profile', 'public');
            $img_name = basename($img_path);
        }


        /** @var \App\Models\User $user */
        $user = auth()->user();
        $user->update([
            'nick_name' => $request->nick_name
        ]);

        Profile::create([
            'user_id' => auth()->id(),
            'real_name' => $request->real_name,
            'payment_id' => $request->payment_id,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building,
            'img' => $img_name
        ]);


        return redirect()->back()->with('message', 'プロフィールを設定しました');

    }

    public function update(ProfileRequest $request)
    {

        if ($request->has('back')) {
            return redirect('/mypage/profile')->withInput();
        }

        $profile = Profile::find($request->id);

        if($request->hasFile('img')) {
            $img_path = $request->file('img')->store('profile', 'public');
            $img_name = basename($img_path);
            $profile->img = $img_name;
        }

        Payment::where('payment', $request->payment)->first();

        $profile_data = $request->only(['payment_id', 'real_name', 'postcode', 'address', 'building']);
        $profile->update($profile_data);

        /** @var \App\Models\User $user */
        $user = auth()->user();
        $user->update([
            'nick_name' => $request->nick_name
        ]);


        return redirect()->route('profile')->with('message', 'プロフィールを変更しました');
    }
}
