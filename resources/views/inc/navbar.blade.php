<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        @if(Request::is('/'))
          <span id="ayy">L</span>
          <span id="ayy">A</span>
          <span id="ayy">R</span>
          <span id="ayy">A</span>
          <span id="ayy">V</span>
          <span id="ayy">E</span>
          <span id="ayy">L</span>
          <span id="ayy">B</span>
          <span id="ayy">L</span>
          <span id="ayy">O</span>
          <span id="ayy">G</span>
        @elseif (Auth::check())
          @if (Request::is('users/'.auth::user()->id))
            <span id="ayy">L</span>
            <span id="ayy">A</span>
            <span id="ayy">R</span>
            <span id="ayy">A</span>
            <span id="ayy">V</span>
            <span id="ayy">E</span>
            <span id="ayy">L</span>
            <span id="ayy">B</span>
            <span id="ayy">L</span>
            <span id="ayy">O</span>
            <span id="ayy">G</span>
          @endif
        @else
          <span>L</span>
          <span>A</span>
          <span>R</span>
          <span>A</span>
          <span>V</span>
          <span>E</span>
          <span>L</span>
          <span>B</span>
          <span>L</span>
          <span>O</span>
          <span>G</span>
        @endif
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">

          </ul>
          <ul class="navbar-nav mr-auto">
            <li class="nav-item {!! Request::is('/') ? 'active' : '' !!}">
              <a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item {!! Request::is('about') ? 'active' : '' !!}">
              <a class="nav-link" href="/about">About</a>
            </li>
            <li class="nav-item {!! Request::is('services') ? 'active' : '' !!}">
              <a class="nav-link" href="/services">Services</a>
            </li>
            <li class="nav-item {!! Request::is('posts*') ? 'active' : '' !!}">
              <a class="nav-link" href="/posts">Blog</a>
          </ul>
          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
              <!-- Authentication Links -->
              @guest
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                  <li class="nav-item">
                      @if (Route::has('register'))
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                      @endif
                  </li>
              @else
                <li class="nav-item">
                  <a class="nav-link" href="/posts/create">Create Post</a>
                </li>
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="/users/{{Auth::user()->id}}">My account</a>  
                          <a class="dropdown-item" href="/dashboard">Dashboard</a>
                          <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                      </div>
                  </li>
              @endguest
          </ul>
      </div>
  </div>
</nav>