@php
    // ログイン画面かどうかを判定
    $isLoginPage = request()->route()->getName() === 'login'
        || request()->is('login');

    // ログイン画面の場合は大きいサイズ、それ以外は小さいサイズを設定
    $dimensions = $isLoginPage ? '160' : '65';
    $classes = $isLoginPage ? 'mx-auto' : '';
@endphp

<img src="{{ asset("images/logo.png") }}"
    width="{{ $dimensions }}"
    height="{{ $dimensions }}"
    class="object-contain {{ $classes }}"
>
