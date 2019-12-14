                    <!-- Right Side Of Navbar Login -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Вход') }}</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <div class="form-row">
                                    <a class="nav-link" href="{{ route('user') }}">
                                        <img src="{{ Auth::user()->photo_url }}" class="rounded-circle" style="margin: -5px 5px -5px -5px;" height="30" width="30">
                                        {{ Auth::user()->name }}&nbsp;</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    &nbsp;{{ __('Выйти') }}
                                </a>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
                    </ul>
