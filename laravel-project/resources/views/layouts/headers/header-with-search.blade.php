<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@200;300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app" class="app">
        <div class="preloader">
            <img src="/images/Spin-1s-200px.svg" alt="">
        </div>
        <header class="header">
                <div class="header-content" id="menuToggle">
                    <a href="{{ url('/') }}" class="logo"><span class="logo-left">WEB</span><span class="logo-right">News</span></a>
                    <div class="menu">
                        <div class="header-left">
                            <ul class="nav-list">
                                @foreach ($categories_sidebar as $item)
                                    <li class="list-item">
                                        <a class="cat-link @if(request()->is("cat/".$item->slug)) active-cat @endif" aria-current="page" href="/cat/{{$item->slug}}"><span class="cat-name">{{$item->name}}</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="header-center">
                            <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
                            <form action="/search" method="get" class="searchForm">
                                <input type="text" id="search" name="q" class="search search-q" placeholder="Search for articles">
                            </form>
                        </div>
                        <div class="header-right">
                        <ul class="header-list">
                            <li class="mode-toggler"><i class="fa-solid fa-palette"></i></li>
                            @guest
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="user" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if (Route::has('login'))
                                        <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    @endif
                                    @if (Route::has('register'))
                                        <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    @endif
                                </div>
                            </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="user" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fa-regular fa-user"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                            <a href="/user" class="dropdown-item">{{ Auth::user()->name }}</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                        </div>
                    </div>
                <div class="burger-div">
                    <span class="burger"></span>
                    <span class="burger"></span>
                    <span class="burger"></span>
                </div>
            </div>
        </header>