    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="{{asset('')}}"><h2>ТЕ<em>905</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">

            <ul class="navbar-nav ml-auto" style = "width:96%">
              <li class="nav-item @if($page == "home")active @endif">
                <a class="nav-link" href="{{asset('/')}}">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li> 
              <li class="nav-item @if($page == "products")active @endif">
                <a class="nav-link" href="{{asset('/products')}}">Our Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link @if($page == "about_us")active @endif" href="about.html">About Us</a>
              </li>
              <li class="nav-item @if($page == "contact_us")active @endif">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>
              {{-- <li> --}}
                            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
              <!-- Authentication Links -->
              {{-- style = "display:none" --}}
              
              @guest
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                  @if (Route::has('register'))
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                  @endif
              @else
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }}
                      </a>
          
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ asset('/profile') }}">
                              {{ __('Profile') }}
                          </a>
                          <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>
                          <a class="dropdown-item" href="{{ asset('/favorits') }}">
                           {{ __('My Favorite') }}
                          </a>
          
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                      </div>
                  </li>
              @endguest
          </ul>
              {{-- </li> --}}
            </ul>
            
          </div>
        </div>
      </nav>
    </header>