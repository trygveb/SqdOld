
  <!-- Right Side Of Navbar -->
  <ul class="navbar-nav ml-auto">
      <!-- Authentication Links -->
      <li class="nav-item dropdown">
         <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            sqd.se
         </a>
         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{route('about')}}" >{{ __('About') }}</a>
            <a class="dropdown-item" href="{{route('contact.showForm')}}" >{{ __('Contact') }}</a>
            <a class="dropdown-item" href="" >{{ __('Privacy') }}</a>
         </div>
      </li>
   @auth
      <li class="nav-item dropdown">
         <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
         </a>
         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{route('schedule.showMySchemas')}}" >{{ __('Schedules') }}
            </a>
            <a class="dropdown-item" href="{{ route('signout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('signout') }}" method="GET" class="d-none">
               @csrf
            </form>
         </div>
      </li>
   @endauth
  </ul>
