<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;


class FavoriteController extends Controller
{
    public function toggleFavorite(ITem $item)
    {
        $user = Auth::user();
        $favorite = Favorite::where('user_id', $user->id)
            ->where('item_id', $item->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return redirect()->back();
        } else {
            $favorite = new Favorite();
            $favorite->user_id = $user->id;
            $favorite->item_id = $item->id;
            $favorite->save();

            return redirect()->back();
        }
    }

}
