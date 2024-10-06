<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtechフリマ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <h1 class="header-ttl"></h1>
        <div class="header-search">
            <form class="search-form" action="">
                <input class="input" type="text" name="keyword" placeholder="何をお探しですが？" value="">
            </form>
        </div>
        @guest
        <nav class="header-nav">
            <ul class="header-nav-list">
                <li class="header-nav-item"><a href="/register">ログイン</a></li>
                <li class="header-nav-item"><a href="/login">会員登録</a></li>
            </ul>
        </nav>
        @else
        <nav class="header-nav">
            @if (Auth::check())
            <ul class="header-nav-list">
                <form action="/logout" method="post" style="display: inline;">
                    @csrf
                    <button type="submit" class="header-nav-item__btn">ログアウト</button>
                </form>
                <li class="header-nav-item"><a href="/mypage">マイページ</a></li>
            </ul>
            @endif
        </nav>
        @endguest
        <a class="sell__link" href="">出品</a>

    </header>


    <main>
        @yield('content')
    </main>
</body>

</html>