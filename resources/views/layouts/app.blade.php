<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>


    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link href="/public/bootstrap-3.3.6-dist/css/bootstrapth.min.css" rel="stylesheet">


    <link href="/public/RWD-Table-Patterns-5.0.4/dist/css/rwd-table.min.css" rel="stylesheet">
    <link href="/public/css/app.css" rel="stylesheet">
    <link href="/public/bootstrap-datepicker-master/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="/public/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js"></script>
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="padding:0;padding-top:2px;padding-bottom:2px;margin-right:30px;" href="{{ url('/') }}">
                    <img src="/public/logo/logo_internity.jpg" class="img-square logo" alt="" />
                </a>

                <!-- Branding Image -->
                <a class="navbar-brand brand" style="float:none !important;"  href="{{ url('/') }}">
                    Plati Facturi Telekom
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @if(Auth::check())
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}">Acasa</a></li>
                </ul>
                  @if(Auth::user()->admin == 1)
                    <ul class="nav navbar-nav">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">CMS <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="/cms/useri">Useri</a></li>
                          <li><a href="/cms/usernou">User Nou</a></li>
                          <li><a href="/cms/rapoarte">Rapoarte</a></li>
                        </ul>
                      </li>
                    </ul>
                  @endif
                @endif

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav ">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                      <!--  <li><a href="{{ url('/login') }}">Logare</a></li>
                        <li><a href="{{ url('/register') }}">Inregistrare</a></li> -->
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/plati') }}"><i class="fa fa-btn fa-sign-out"></i>Plati</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Iesire</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
                <a class="navbar-brand navbar-right" style="padding:0;padding-top:2px;padding-bottom:2px;margin-left:20px;" href="{{ url('/') }}">
                    <img src="/public/logo/tmob.jpg" class="img-square logo" alt="" />
                </a>
            </div>

        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
