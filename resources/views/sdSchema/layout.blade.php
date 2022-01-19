<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-html-head title="sdSchema" />
<body>
   <div id="app">
      <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
         <a  href="{{ route('home',[]) }}" style="color:white;">{{ config('app.name', 'sqd.se') }}</a>
         <x-flags-div />

         <div class="collapse navbar-collapse" id="navbarSupportedContent">
         @php
            $admin = 1;
         @endphp
         @if ($admin > 0)    
            <ul class="navbar-nav mr-auto">

               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Administration
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      @yield('menu1')
                     <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                       <a class="dropdown-item" href="#">Something else here</a>
                     </div>
               </li>
            </ul>
         @endif
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <!-- Left Side Of Navbar -->
               <ul class="navbar-nav mr-auto">
               </ul>
               <x-right-side-of-navbar />
            </div>
         </div>
      </nav>

   <main class="p-4">
       @yield('content')
   </main>
   </div>
   <x-footer subApp="sdSchema" />

    @yield('scripts')
    <!-- Scripts -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
