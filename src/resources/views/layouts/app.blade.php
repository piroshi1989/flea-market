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
            @guest
            <a class="header__logo" href="/">
            @endguest
            @auth
            <a class="header__logo" href="/user">
            @endauth
            <svg viewBox="0 0 370 36" fill="none" xmlns="http://www.w3.org/2000/svg" class="custom-svg">
            <path d="M99.11 25.05C97.79 31.38 93.03 36 84.55 36C73.81 36 68.76 28.39 68.76 18.77C68.76 9.15 74.01 1.19 84.89 1.19C93.91 1.19 98.27 6.44 99.11 12.14H91.81C91.07 9.49 89.26 6.89 84.65 6.89C78.62 6.89 76.32 12.34 76.32 18.53C76.32 24.23 78.33 30.26 84.85 30.26C89.65 30.26 91.12 27.07 91.76 25.06H99.11V25.05Z" fill="white"/>
            <path d="M136.46 18.47C136.46 27.9 130.82 36 119.84 36C108.86 36 103.66 28.29 103.66 18.57C103.66 8.85 109.79 1.19 120.28 1.19C130.18 1.19 136.46 8.11 136.46 18.47ZM111.21 18.42C111.21 25.05 114.1 30.06 120.08 30.06C126.6 30.06 128.9 24.61 128.9 18.57C128.9 12.14 126.25 7.13 119.98 7.13C113.71 7.13 111.2 11.84 111.2 18.42H111.21Z" fill="white"/>
            <path d="M205.24 25.05C203.92 31.38 199.16 36 190.68 36C179.94 36 174.89 28.39 174.89 18.77C174.89 9.15 180.14 1.19 191.02 1.19C200.04 1.19 204.4 6.44 205.24 12.14H197.94C197.2 9.49 195.39 6.89 190.78 6.89C184.75 6.89 182.45 12.34 182.45 18.53C182.45 24.23 184.46 30.26 190.98 30.26C195.78 30.26 197.25 27.07 197.89 25.06H205.24V25.05Z" fill="white"/>
            <path d="M211.46 1.67999H218.76V14.84H232.39V1.67999H239.69V35.51H232.39V20.88H218.76V35.51H211.46V1.67999Z" fill="white"/>
            <path d="M254.5 7.66999H244.21V1.67999H272.06V7.66999H261.81V35.51H254.51V7.66999H254.5Z" fill="white"/>
            <path d="M299.85 20.93H283.67V29.52H301.51L300.63 35.51H276.56V1.67999H300.53V7.66999H283.67V14.89H299.85V20.93Z" fill="white"/>
            <path d="M335.54 25.05C334.22 31.38 329.46 36 320.98 36C310.24 36 305.19 28.39 305.19 18.77C305.19 9.15 310.44 1.19 321.32 1.19C330.34 1.19 334.7 6.44 335.54 12.14H328.24C327.5 9.49 325.69 6.89 321.08 6.89C315.05 6.89 312.75 12.34 312.75 18.53C312.75 24.23 314.76 30.26 321.28 30.26C326.08 30.26 327.55 27.07 328.19 25.06H335.54V25.05Z" fill="white"/>
            <path d="M341.76 1.67999H349.06V14.84H362.69V1.67999H369.99V35.51H362.69V20.88H349.06V35.51H341.76V1.67999Z" fill="white"/>
            <path d="M159.99 1.67999H150.82L139.35 35.51H146.56C148.47 29.37 154.31 10.27 155.14 6.92999H155.19C156.02 9.96999 161.91 28.34 164.31 35.51H172.01L159.99 1.67999Z" fill="white"/>
            <path d="M56.69 0H22.26C12.33 0 2.55001 8.06 0.420005 18C-1.71999 27.94 4.60001 36 14.52 36H25.41C26.88 36 28.33 34.81 28.65 33.33L30.17 26.27C30.49 24.8 29.55 23.6 28.08 23.6H15.97C13.21 23.6 11.26 21.47 11.77 18.71C12.3 15.85 15.09 13.51 17.93 13.51H36.97C38.44 13.51 39.38 14.7 39.06 16.18L35.37 33.34C35.05 34.81 35.99 36.01 37.46 36.01H46.29C47.76 36.01 49.21 34.82 49.53 33.34L53.22 16.18C53.54 14.71 54.99 13.51 56.46 13.51C57.93 13.51 59.38 12.32 59.7 10.84L62.03 0H56.7L56.69 0Z" fill="white"/>
            </svg>
            </a>
        </div>
        <div class="header__item">
            <div class="search__form">
                <form method="post" action="/search" id="searchForm">
                    @csrf
                    <div class="search-form__content">
                        <input type="hidden" name="form__type" value="search__form">
                        <select name="category" class="category">
                            <option value="">カテゴリー</option>
                            @foreach($categories as $category)
                            <option class="categories__option" value="{{ $category['id']}}" {{ $selectedCategory == $category['id'] ? 'selected' : '' }}>
                            {{ $category['name'] }}
                            </option>
                            @endforeach
                        </select>
                        <select name="brand" class="brand">
                            <option value="">ブランド</option>
                            @foreach($brands as $brand)
                            <option class="brands__option" value="{{ $brand['id']}}" {{ $selectedBrand == $brand['id'] ? 'selected' : '' }}>
                            {{ $brand['name'] }}
                            </option>
                            @endforeach
                        </select>
                        <input type="text" class="keyword" name="keyword" placeholder="なにをお探しですか?" onkeydown="return handleEnterKey(event)">
                        <input type="submit" class="submit-button">
                    </div>
                </form>
            </div>
            <nav class="nav">
                <ul class="header-nav">
                    @guest
                    <li class="header-nav__item">
                        <a class="header-nav__link" href="/login">ログイン</a>
                    </li>
                    <li class="header-nav__item">
                        <a class="header-nav__link" href="/register">会員登録</a>
                    </li>
                    @endguest
                    @auth
                    <li class="header-nav__item">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="header-nav__button" type="submit">ログアウト</button>
                        </form>
                    </li>
                    @endauth
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
    function handleEnterKey(event) {
        // イベントからキーコードを取得
        var keyCode = event.keyCode || event.which;

        // Enterキーのキーコードは 13
        if (keyCode === 13) {
            // フォームを送信
            document.getElementById('searchForm').submit();
            return false; // デフォルトの動作をキャンセル
        }

        return true; // 他のキーはそのまま処理
    }
    </script>
</body>
</html>