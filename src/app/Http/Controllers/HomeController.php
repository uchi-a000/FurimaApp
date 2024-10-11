<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('index', compact('items'));
    }

    public function sell(Request $request)
    {
        $user = Auth::user();
        $items = Item::where('user_id', $user->id)->get();
        $categories = Category::all();
        $conditions = Condition::all();

        return view('sell', compact('items', 'categories', 'conditions'));
    }
}
