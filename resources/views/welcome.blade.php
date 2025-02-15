<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-NDWX1WNW0X"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-NDWX1WNW0X');
        </script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', '転職マネージャー') }}</title>

        {{-- ファビコン --}}
        <link rel="icon" type="image/png" href="{{ asset('favicon.png ')}}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @viteReactRefresh
        @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div id="animated-title" class="w-full flex justify-center items-center">

            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                @if (Route::has('login'))
                    <div class="flex justify-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70">
                                ログイン
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70">
                                    新規登録
                                </a>
                            @endif
                        @endauth
                    </div>
                    <!-- Googleログインボタン -->
                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('login.google') }}" class="ml-3 inline-flex items-center">
                            <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
                        </a>
                    </div>
                @endif
            </div>
            {{-- 説明画像 --}}
            <div class="mt-6 mx-auto px-4" style="max-width: 1000px">
                <p class="text-gray-800 mb text-center">
                    使用例
                </p>
                <img src="{{ asset('images/explanatoryImage.png')}}" alt=""
                    alt="転職マネージャーの使用例"
                    class="w-full h-auto rounded-lg shadow-lg ">
            </div>
        </div>
    </body>
</html>
