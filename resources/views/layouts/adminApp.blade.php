<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="{{ asset('js/app.js') }}"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/nicEdit.js') }}" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

</head>
<body>
<div id="app">
    <nav class="navbar navbar-tc navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <button type="button" class="btn btn-tc dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false" aria-haspopup="true" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Выход
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
                
            </div>
        </div>
    </nav>

    <div class="container" style="width: 90% !important">
        <div class="row">
            <div class="col-sm-3 left-menu">

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            &nbsp;
                        </ul>
        
                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-left">
                            <?php
                            $admin = Auth::user()->admin;    
                            ?>
        
                            {{-- <li class="active"><a href="{{ route('auth.home') }}">Главная</a></li> --}}
        
                            <li style="width: 100%"><a href="{{ route('auth.news.index') }}">Новости</a></li>
        
                            @if($admin == 1)

                            <li style="width: 100%"><a href="{{ route('auth.contests.index') }}">Конкурсы</a></li>
        
                            <li style="width: 100%"><a href="{{ route('auth.cases.index') }}">Кейсы/успешные практики</a></li>
        
                            <li style="width: 100%"><a href="{{ route('auth.events.index') }}">События</a></li>
        
                            <li style="width: 100%"><a href="{{ route('auth.polls.index') }}">Онлайн голосование</a></li>
        
                            <li style="width: 100%"><a href="{{ route('auth.documents.index') }}">Документы</a></li>
        
                            <li style="width: 100%"><a href="{{ route('auth.messenger.index') }}">Мессенджер</a></li>
        
                            <li style="width: 100%"><a href="{{ route('auth.mods.index') }}">Модераторы</a></li>
        
                            @endif

                            <li style="width: 100%"><a href="{{ route('auth.user.show', ['id' => Auth::user()->id]) }}">Личный кабинет</a></li>
                        </ul>
                    </div>
            </div>
            <div class="col-sm-9 tabs-content">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
</body>
</html>
