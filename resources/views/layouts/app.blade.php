<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'sqd.se') }}</title>

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrapDarkly.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sqd.css?v=12345678') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
            <a  href="{{ route('home',[]) }}" style="color:white;">{{ config('app.name', 'sqd.se') }}</a>
            <div class="container">
            @if (isset($training))
                <a class="navbar-brand" href="{{ route('schema.index',['trainingId' => $training->id]) }}">
                    {{$training->name}}
                </a>
            @endif
            
            @auth
            @if (Auth::user()->authority > 1)
               @if (isset($training))
               <a href="{{route('admin.showMenu',['training' =>$training])}}" class="btn btn-primary" role="button">Administration</a>
               @endif
            @endif
            @endauth
            
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <!--if (isset($showAuthenticationLinks))-->
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
<!--                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login',['app' =>'schema']) }}">{{ __('Login') }}</a>
                            </li>
-->                            @if (Route::has('register-user'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register-user') }}">{{ __('Register') }}</a>
                                </li>
                            @endif<!--
                        @else-->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('signout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('signout') }}" method="GET" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        <!--@endguest-->
                    </ul>
<!--endif-->
                </div>
            </div>
        </nav>

        <main class="p-4">
            @yield('content')
        </main>
    </div>
    <footer class="footer">
      <div class="container" style="text-align:center;  padding-bottom:20px;">
        <span class="text-muted" >sqd.se &nbsp;@include('version',[])&nbsp;&nbsp;(@include('versionTime',[]))</span>
      </div>
    </footer>  
    @yield('scripts')
    <!-- Scripts -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
