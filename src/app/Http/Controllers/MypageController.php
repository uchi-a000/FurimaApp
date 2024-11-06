<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;


class MypageController extends Controller
{
    public function myPage()
    {

        $user = Auth::user();

        $items = Item::where('user_id', $user->id)->get();
        $profile = Profile::where('user_id', $user->id)->first();

        return view('my_page', compact('items', 'profile'));
    }

    public function profile()
    {

        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();

        return view('profile', compact('profile'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('img')) {
            $img = $request->file('img')->store('profile', 'public');
        }

        Profile::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building,
            'img' => $img
        ]);

        return redirect()->back()->with('message', 'プロフィールを設定しました');

    }

    public function update(Request $request)
    {

        if ($request->has('back')) {
            return redirect('/mypage/profile')->withInput();
        }

        $profile = Profile::find($request->id);

        if ($request->hasFile('img')) {
            $img_path = $request->file('img')->store('profile', 'public');
            $img_name = basename($img_path);
            $profile->img = $img_name;
        }

        $profile_data = $request->only(['name', 'postcode', 'address', 'building']);
        $profile->update($profile_data);

        return redirect()->route('profile')->with('message', 'プロフィールを変更しました');
    }
}
