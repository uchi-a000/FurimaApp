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
        <div class="header__inner">
            <h2><a class="logo-link" href="/"></a></h2>
            @if(!Request::is('login') && !Request::is('register') && !Request::is('sell'))
            <div class="header-search">
                <form class="search-form" action="/search" method="GET">
                    <input class="search-input" type="text" name="keyword" placeholder="なにをお探しですが？" value="{{ old('keyword', $keyword ?? '') }}">
                </form>
            </div>
            @guest
            <nav class="header-nav">
                <ul class="header-nav-list">
                    <li class="header-nav-item"><a href="/login">ログイン</a></li>
                    <li class="header-nav-item"><a href="/register">会員登録</a></li>
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
                    <li class="header-nav-item"><a href="/mypage/purchase">マイページ</a></li>
                    <!-- 管理者メニュー -->
                    @if(Auth::user()->hasRole('admin'))
                    <li class="header-nav-item"><a href="/admin/users">ユーザー一覧</a></li>
                    @endif
                </ul>
                @endif
            </nav>
            @endguest
            <div>
                <a class="sell__link" href="/sell">出品</a>
            </div>
            @endif
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>

</html>