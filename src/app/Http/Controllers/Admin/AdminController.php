<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;

class AdminController extends Controller
{
    public function adminIndex()
    {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');

        })->paginate(5);

        return view('admin.admin_index', compact('users'));
    }

    public function userDestroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.admin_index')->with('success', 'ユーザーを削除しました' );
    }


    public function commentDestroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('comment', ['id' => $comment->id])->with('success', 'コメントを削除しました');
    }

}
