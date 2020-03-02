<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.maskedinput.min.js') }}" type="text/javascript"></script>

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

    <div class="container" style="width: 100% !important">
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
        
                            <li name="news" style="width: 100%"><a href="{{ route('auth.news.index') }}">Новости</a></li>
        
                            @if($admin == 1)

                            <li name="contests" style="width: 100%"><a href="{{ route('auth.contests.index') }}">Конкурсы</a></li>
        
                            <li name="cases" style="width: 100%"><a href="{{ route('auth.cases.index') }}">Кейсы/успешные практики</a></li>
        
                            <li name="events" style="width: 100%"><a href="{{ route('auth.events.index') }}">События</a></li>
        
                            <li name="polls" style="width: 100%"><a href="{{ route('auth.polls.index') }}">Онлайн голосование</a></li>
        
                            <li name="documents" style="width: 100%"><a href="{{ route('auth.documents.index') }}">Документы</a></li>

                            <li name="grants" style="width: 100%"><a href="{{ route('auth.grants.index') }}">Президентские гранты</a></li>

                            <ul>
                                <li name="g1" style="width: 100%"><a href="{{ route('auth.g1') }}">Для победителей</a></li>
                                <li name="g2" style="width: 100%"><a href="{{ route('auth.g2') }}">Для участников</a></li>
                                <li name="g3" style="width: 100%"><a href="{{ route('auth.g3') }}">Список победителей с РС (Я)</a></li>
                            </ul>

                            <li name="contacts" style="width: 100%"><a href="{{ route('auth.contacts.index') }}">Контакты</a></li>

                            <li name="faq" style="width: 100%"><a href="{{ route('auth.faq.index') }}">Вопрос-ответ</a></li>
        
                            <li name="messenger" style="width: 100%"><a href="{{ route('auth.messenger.index') }}">Мессенджер</a></li>
        
                            <li name="mods" style="width: 100%"><a href="{{ route('auth.mods.index') }}">Модераторы</a></li>

                            <li name="about" style="width: 100%"><a href="{{ route('auth.about.index') }}">О приложении</a></li>
        
                            @endif

                            <li name="user" style="width: 100%"><a href="{{ route('auth.user.show', ['id' => Auth::user()->id]) }}">Личный кабинет</a></li>
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
<script>
    $(document).ready(function() {

        let pathname = window.location.pathname;

        switch(pathname.split('/')[1]) {
        case 'news':
            $( "li[name='news']" ).addClass( "active" );
            break;

        case 'contests':
            $( "li[name='contests']" ).addClass( "active" );
            break;

        case 'cases':
            $( "li[name='cases']" ).addClass( "active" );
            break;

        case 'events':
            $( "li[name='events']" ).addClass( "active" );
            break;

        case 'polls':
            $( "li[name='polls']" ).addClass( "active" );
            break;

        case 'documents':
            $( "li[name='documents']" ).addClass( "active" );
            break;

        case 'grants':
            $( "li[name='grants']" ).addClass( "active" );
            break;

        case 'contacts':
            $( "li[name='contacts']" ).addClass( "active" );
            break;

        case 'faq':
            $( "li[name='faq']" ).addClass( "active" );
            break;

        case 'messenger':
            $( "li[name='messenger']" ).addClass( "active" );
            break;

        case 'mods':
            $( "li[name='mods']" ).addClass( "active" );
            break;

        case 'user':
            $( "li[name='user']" ).addClass( "active" );
            break;

        case 'about':
            $( "li[name='about']" ).addClass( "active" );
            break;
        }

        case 'g1':
            $( "li[name='g1']" ).addClass( "active" );
            break;

        case 'g2':
            $( "li[name='g2']" ).addClass( "active" );
            break;

        case 'g3':
            $( "li[name='g3']" ).addClass( "active" );
            break;
        }
    })
</script>
</body>
</html>
