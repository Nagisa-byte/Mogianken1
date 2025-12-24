<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フリマアプリ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('styles')
</head>

<body>

    <header>
        <div class="nav-container">

            {{-- 左：ロゴ --}}
            <div class="nav-left">
                <a href="/">
                    <img src="{{ asset('images/coachtech.jpg') }}" alt="COACHTECH">
                </a>
            </div>
            {{-- 中央：検索窓 --}}
            <div class="nav-center">
                <form action="/" method="GET" style="width:100%;">
                    <input
                        type="text"
                        name="keyword"
                        placeholder="なにをお探しですか？"
                        value="{{ request('keyword') }}">
                </form>
            </div>
            {{-- 右：メニュー --}}
            <div class="nav-right">
                {{-- ログイン中の表示 --}}
                @auth
                {{-- ログアウト --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">ログアウト</button>
                </form>

                <a href="{{ route('mypage') }}">マイページ</a>
                <a href="{{ route('sell.create') }}" class="sell-btn">出品</a>

                @endauth


                {{-- 未ログイン時の表示 --}}
                @guest
                {{-- ログインボタン --}}
                <a href="{{ route('login') }}">ログイン</a>

                {{-- マイページ / 出品 → アカウント登録ページへ誘導 --}}
                <a href="{{ route('login') }}">マイページ</a>
                <a href="{{ route('login') }}" class="sell-btn">出品</a>
                @endguest

            </div>
        </div>

    </header>

    <main>
        @yield('content')
    </main>

</body>

</html>