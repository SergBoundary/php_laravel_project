                    <!-- Right Side Of Navbar Login -->
                    <ul class="navbar-nav ml-auto" style="margin-right: 10px">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a id="nav-login-log-in" class="nav-link" href="{{ route('login') }}">{{ $interface['nav-login']['nav-login-log-in'] }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link">|</a>
                            </li>
                            <li class="nav-item">
                                <a id="nav-login-registration" class="nav-link" href="{{ route('register') }}">{{ $interface['nav-login']['nav-login-registration'] }}</a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link">|</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <div class="form-row">
                                    <a class="nav-link" href="{{ route('user') }}">
                                        <img src="{{ Auth::user()->photo_url }}" class="rounded-circle" style="margin: -5px 5px -5px -5px;" height="30" width="30">
                                        {{ Auth::user()->name }}&nbsp;{{ Auth::user()->surname }}&nbsp;</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">|</a>
                            </li>
                            <li class="nav-item">
                                <a id="nav-login-logout" class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    &nbsp;{{ $interface['nav-login']['nav-login-logout'] }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">|</a>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
                    </ul>
