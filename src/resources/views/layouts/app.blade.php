<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>flea-market</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                <svg xmlns="http://www.w3.org/2000/svg" width="63" height="36" viewBox="0 0 63 36" fill="none">
                <path d="M56.69 0H22.26C12.33 0 2.55001 8.06 0.420005 18C-1.71999 27.94 4.60001 36 14.52 36H25.41C26.88 36 28.33 34.81 28.65 33.33L30.17 26.27C30.49 24.8 29.55 23.6 28.08 23.6H15.97C13.21 23.6 11.26 21.47 11.77 18.71C12.3 15.85 15.09 13.51 17.93 13.51H36.97C38.44 13.51 39.38 14.7 39.06 16.18L35.37 33.34C35.05 34.81 35.99 36.01 37.46 36.01H46.29C47.76 36.01 49.21 34.82 49.53 33.34L53.22 16.18C53.54 14.71 54.99 13.51 56.46 13.51C57.93 13.51 59.38 12.32 59.7 10.84L62.03 0H56.7L56.69 0Z" fill="white"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="35" viewBox="0 0 32 35" fill="none">
                <path d="M31.11 24.05C29.79 30.38 25.03 35 16.55 35C5.81001 35 0.76001 27.39 0.76001 17.77C0.76001 8.15 6.01001 0.190002 16.89 0.190002C25.91 0.190002 30.27 5.44 31.11 11.14H23.81C23.07 8.49 21.26 5.89 16.65 5.89C10.62 5.89 8.32001 11.34 8.32001 17.53C8.32001 23.23 10.33 29.26 16.85 29.26C21.65 29.26 23.12 26.07 23.76 24.06H31.11V24.05Z" fill="white"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="35" viewBox="0 0 34 35" fill="none">
                <path d="M33.46 17.47C33.46 26.9 27.82 35 16.84 35C5.86003 35 0.660034 27.29 0.660034 17.57C0.660034 7.85 6.79003 0.190002 17.28 0.190002C27.18 0.190002 33.46 7.11 33.46 17.47ZM8.21003 17.42C8.21003 24.05 11.1 29.06 17.08 29.06C23.6 29.06 25.9 23.61 25.9 17.57C25.9 11.14 23.25 6.13 16.98 6.13C10.71 6.13 8.20003 10.84 8.20003 17.42H8.21003Z" fill="white"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="35" viewBox="0 0 34 35" fill="none">
                <path d="M20.99 0.679993H11.82L0.350037 34.51H7.56003C9.47003 28.37 15.31 9.26999 16.14 5.92999H16.19C17.02 8.96999 22.91 27.34 25.31 34.51H33.01L20.99 0.679993Z" fill="white"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="35" viewBox="0 0 32 35" fill="none">
                <path d="M31.24 24.05C29.92 30.38 25.16 35 16.68 35C5.94001 35 0.890015 27.39 0.890015 17.77C0.890015 8.15 6.14002 0.190002 17.02 0.190002C26.04 0.190002 30.4 5.44 31.24 11.14H23.94C23.2 8.49 21.39 5.89 16.78 5.89C10.75 5.89 8.45001 11.34 8.45001 17.53C8.45001 23.23 10.46 29.26 16.98 29.26C21.78 29.26 23.25 26.07 23.89 24.06H31.24V24.05Z" fill="white"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="29" height="35" viewBox="0 0 29 35" fill="none">
                <path d="M0.460022 0.679993H7.76001V13.84H21.39V0.679993H28.69V34.51H21.39V19.88H7.76001V34.51H0.460022V0.679993Z" fill="white"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="29" height="35" viewBox="0 0 29 35" fill="none">
                <path d="M10.5 6.66999H0.210022V0.679993H28.06V6.66999H17.81V34.51H10.51V6.66999H10.5Z" fill="white"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="35" viewBox="0 0 26 35" fill="none">
                <path d="M23.85 19.93H7.67001V28.52H25.51L24.63 34.51H0.559998V0.679993H24.53V6.66999H7.67001V13.89H23.85V19.93Z" fill="white"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="35" viewBox="0 0 31 35" fill="none">
                <path d="M30.54 24.05C29.22 30.38 24.46 35 15.98 35C5.24001 35 0.190002 27.39 0.190002 17.77C0.190002 8.15 5.44001 0.190002 16.32 0.190002C25.34 0.190002 29.7 5.44 30.54 11.14H23.24C22.5 8.49 20.69 5.89 16.08 5.89C10.05 5.89 7.75 11.34 7.75 17.53C7.75 23.23 9.76 29.26 16.28 29.26C21.08 29.26 22.55 26.07 23.19 24.06H30.54V24.05Z" fill="white"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="29" height="35" viewBox="0 0 29 35" fill="none">
                <path d="M0.76001 0.679993H8.06V13.84H21.69V0.679993H28.99V34.51H21.69V19.88H8.06V34.51H0.76001V0.679993Z" fill="white"/>
                </svg>
            </a>
        </div>
        <div class="header__item">
        <div class= "search__form">
    <form method="post" action="/search">
    @csrf
    <div class="form__content">
        <input type="text" class="keyword" name="keyword" placeholder=なにをお探しですか？>
        <input type="submit" class="submit-button">
    </form>
</div>
<nav>
    <ul class="header-nav">
        @if (Auth::guest())
        <li class="header-nav__item">
            <a class="header-nav__link" href="/login">ログイン</a>
        </li>
        <li class="header-nav__item">
            <a class="header-nav__link" href="/register">会員登録</a>
        </li>
        @endif
        @if (Auth::check())
        <li class="header-nav__item">
            <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="header-nav__button" type="submit">ログアウト</button>
            </form>
        </li>
        @endif
        @can('user')
        <li class="header-nav__item">
            <a class="header-nav__link" href="/mypage">マイページ</a>
        </li>
        <li class="header-nav__item">
            <a class="header-nav__link sell" href="/sell">出品</a>
        </li>
        @endcan
        @can('admin')
        <li class="header-nav__item">
            <a class="header-nav__link sell" href="/management">管理画面</a>
        </li>
        @endcan
    </ul>
</nav>
        </div>
    </header>

    <main>
    @yield('content')
    </main>
<script>
document.addEventListener("DOMContentLoaded", function() {
  var form = document.querySelector(".form");
  var keywordInput = document.querySelector(".keyword");

  // キーワード入力欄でEnterキーが押されたときにフォームを送信
  keywordInput.addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
      event.preventDefault(); // デフォルトの送信動作をキャンセル
      form.submit(); // フォームを送信
    }
  });
});
</script>
</body>
</html>