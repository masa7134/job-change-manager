@php
    // ページの判定
    $currentRouteName = request()->route()->getName();
    $isLoginOrWelcome = $currentRouteName === 'login'
        || request()->is('login')
        || $currentRouteName === 'register'
        || request()->is('register')
        || $currentRouteName === 'welcome'
        || request()->is('/');

    // ログイン画面の場合は大きいサイズ、それ以外は小さいサイズを設定
    $dimensions = $isLoginOrWelcome ? '160' : '65';
    $classes = $isLoginOrWelcome ? 'mx-auto' : '';
@endphp

<img src="{{ asset("images/logo.png") }}"
    width="{{ $dimensions }}"
    height="{{ $dimensions }}"
    class="object-contain {{ $classes }}"
>
