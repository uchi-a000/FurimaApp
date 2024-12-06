@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/admin_index.css') }}">
@endsection

@section('content')
<div class="users__container">
    <h2>ユーザー一覧</h2>

    @if(Session('success'))
    <div class="alert--success">
        {{ session('success') }}
    </div>
    @endif

    <table class="users__table">
        <tr class="users__row">
            <th class="users__label">ID</th>
            <th class="users__label">ニックネーム</th>
            <th class="users__label">メールアドレス</th>
        </tr>
        @foreach($users as $user)
        <tr class="users__row">
            <td class="users__data">{{ $user->id }}</td>
            <td class="users__data">{{ $user->name }}</td>
            <td class="users__data">{{ $user->email }}</td>
            <td class="user-destroy">
                <form action="{{ route('admin.users_destroy', $user->id) }}" method="POST" onclick="return confirm('本当に削除しますか？')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete_btn">削除する</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="pagination">
        {{ $users->links('vendor.pagination.custom') }}
    </div>
</div>
@endsection