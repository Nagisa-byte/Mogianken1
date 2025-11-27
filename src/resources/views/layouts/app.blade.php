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
                @guest
                <a href="/login">ログイン</a>
                <a href="/register">会員登録</a>
                @endguest

                @auth
                <a href="/mypage">マイページ</a>

                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">ログアウト</button>
                </form>
                @endauth
                <a href="/sell" class="sell-btn">出品</a>

            </div>
        </div>

    </header>

    <main>
        @yield('content')
    </main>

</body>

</html>