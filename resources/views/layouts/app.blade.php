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
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- SEO用の基本的なメタタグ --}}
        <meta name="description" content="転職活動の進捗を簡単に一元管理。履歴書・職務経歴書の作成状況、面接日程、選考状況をシンプルに管理できる無料Webアプリ。Googleアカウントでログインしてすぐに使えます。">
        <meta name="keywords" content="転職マネージャー,転職管理,転職進捗,面接管理,転職活動,就活管理">
        <meta name="author" content="転職マネージャー">

        {{-- 構造化データ (JSON-LD形式) --}}
        <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@type": "WebApplication",
                "name": "転職マネージャー",
                "description": "転職活動の進捗を簡単に一元管理。履歴書・職務経歴書の作成状況、面接日程、選考状況をシンプルに管理できる無料Webアプリ。",
                "url": "https://job-change-manager.com",
                "applicationCategory": "BusinessApplication",
                "operatingSystem": "All",
                "offers": {
                    "@type": "Offer",
                    "price": "0",
                    "priceCurrency": "JPY"
                },
                "creator": {
                    "@type": "Person",
                    "name": "転職マネージャー開発者"
                }
            }
            </script>

        {{-- タイトル設定 --}}
        <title>@yield('title', '転職マネージャー - 転職活動の進捗を一元管理')</title>

        {{-- canonical URL（公式なurlを指定） --}}
        <link rel="canonical" href="{{ url()->current() }}">

        {{-- OGPタグの追加(SNS用) --}}
        <meta property="og:title" content="転職マネージャー - 転職活動の進捗を一元管理">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:image" content="{{ asset('images/ogp.png' )}}">
        <meta property="og:site_name" content="転職マネージャー">
        <meta property="og:description" content="転職活動の進捗を簡単に一元管理。履歴書・職務経歴書の作成状況、面接日程、選考状況をシンプルに管理できる無料Webアプリ。">

        {{-- Twitter Card --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="転職マネージャー">
        <meta name="twitter:description" content="転職活動の進捗を簡単に一元管理。履歴書・職務経歴書の作成状況、面接日程、選考状況をシンプルに管理できる無料Webアプリ。">

        {{-- ファビコン --}}
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

        <!-- FlatpickrのCSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- FlatpickrのJavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            {{-- ナビゲーションバー --}}
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
