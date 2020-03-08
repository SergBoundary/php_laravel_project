                    <!-- Left Side Of Navbar Menu-->
                    @guest
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="/"><span id="nav-title" class="navbar-text">{{ $interface['title'] }}</span></a>
                            </li>
                        </ul>
                    @else
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                                <a id="nav-menu-personnel" class="nav-link dropdown-toggle" href="#" id="navbarHumanResources" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $interface['nav-menu']['nav-menu-personnel'] }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarHumanResources">
                                    <a id="nav-menu-human-resources" class="dropdown-item" href="/hr/personal-cards">{{ $interface['nav-menu']['nav-menu-human-resources'] }}</a>
                                    <a id="nav-menu-teams" class="dropdown-item" href="/hr/teams">{{ $interface['nav-menu']['nav-menu-teams'] }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a id="nav-menu-appointments" class="dropdown-item" href="/hr/manning-orders">{{ $interface['nav-menu']['nav-menu-appointments'] }}</a>
                                    <a id="nav-menu-allocations" class="dropdown-item" href="/hr/allocations">{{ $interface['nav-menu']['nav-menu-allocations'] }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a id="nav-menu-billeting" class="dropdown-item disabled" href="/hr/billeteds">{{ $interface['nav-menu']['nav-menu-billeting'] }}</a>
                                    <a id="nav-menu-vacations" class="dropdown-item disabled" href="/hr/vacations">{{ $interface['nav-menu']['nav-menu-vacations'] }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a id="nav-menu-hr-analytics" class="dropdown-item disabled" href="/hr/hr-analytics">{{ $interface['nav-menu']['nav-menu-hr-analytics'] }}</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="nav-menu-finance" class="nav-link dropdown-toggle" href="#" id="navbarAccounting" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $interface['nav-menu']['nav-menu-finance'] }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarAccounting">
                                    <a id="nav-menu-piecework" class="dropdown-item" href="/acc/pieceworks">{{ $interface['nav-menu']['nav-menu-piecework'] }}</a>
                                    <a id="nav-menu-time-work" class="dropdown-item" href="/acc/base-timesheets">{{ $interface['nav-menu']['nav-menu-time-work'] }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a id="nav-menu-accruals" class="dropdown-item" href="/acc/accruals">{{ $interface['nav-menu']['nav-menu-accruals'] }}</a>
                                    <a id="nav-menu-deductions" class="dropdown-item" href="/acc/retentions">{{ $interface['nav-menu']['nav-menu-deductions'] }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a id="nav-menu-payroll" class="dropdown-item" href="/calc/payrolls">{{ $interface['nav-menu']['nav-menu-payroll'] }}</a>
                                    <a id="nav-menu-paycheck" class="dropdown-item" href="/calc/paychecks">{{ $interface['nav-menu']['nav-menu-paycheck'] }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a id="nav-menu-fin-analytics" class="dropdown-item disabled" href="/calc/fin-analytics">{{ $interface['nav-menu']['nav-menu-fin-analytics'] }}</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="nav-menu-references" class="nav-link dropdown-toggle" href="#" id="navbarReferences" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $interface['nav-menu']['nav-menu-references'] }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarReferences">
                                    <a id="nav-menu-countries" class="dropdown-item disabled" href="/ref/countries">{{ $interface['nav-menu']['nav-menu-countries'] }}</a>
                                    <a id="nav-menu-calendars" class="dropdown-item disabled" href="/ref/calendars">{{ $interface['nav-menu']['nav-menu-calendars'] }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a id="nav-menu-divisions" class="dropdown-item" href="/ref/departments">{{ $interface['nav-menu']['nav-menu-divisions'] }}</a>
                                    <a id="nav-menu-projects" class="dropdown-item" href="/ref/objects">{{ $interface['nav-menu']['nav-menu-projects'] }}</a>
                                    <a id="nav-menu-housing" class="dropdown-item disabled" href="/ref/hotels">{{ $interface['nav-menu']['nav-menu-housing'] }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a id="nav-menu-positions-classifier" class="dropdown-item" href="/ref/position-professions">{{ $interface['nav-menu']['nav-menu-positions-classifier'] }}</a>
                                    <a id="nav-menu-accruals-classifier" class="dropdown-item" href="/ref/positions">{{ $interface['nav-menu']['nav-menu-accruals-classifier'] }}</a>
                                    <a id="nav-menu-deductions-classifier" class="dropdown-item" href="/ref/accrual-types">{{ $interface['nav-menu']['nav-menu-deductions-classifier'] }}</a>
                                </div>
                            </li>
                        @if(Auth::user()->access == 0)
                            <li class="nav-item dropdown">
                                <a id="nav-menu-settings" class="nav-link dropdown-toggle" href="#" id="navbarSettings" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $interface['nav-menu']['nav-menu-settings'] }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarSettings">
                                    <a id="nav-menu-users" class="dropdown-item" href="/set/users">{{ $interface['nav-menu']['nav-menu-users'] }}</a>
                                    <a id="nav-menu-menu" class="dropdown-item" href="/set/menus">{{ $interface['nav-menu']['nav-menu-menu'] }}</a>
                                </div>
                            </li>
                        @elseif(Auth::user()->access == 1)
                            <li class="nav-item dropdown">
                                <a id="nav-menu-settings" class="nav-link dropdown-toggle" href="#" id="navbarSettings" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $interface['nav-menu']['nav-menu-settings'] }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarSettings">
                                    <a id="nav-menu-users" class="dropdown-item" href="/set/users">{{ $interface['nav-menu']['nav-menu-users'] }}</a>
                                </div>
                            </li>
                        @elseif(Auth::user()->access == 2)
                            <li class="nav-item dropdown">
                                <a id="nav-menu-settings" class="nav-link dropdown-toggle" href="#" id="navbarSettings" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $interface['nav-menu']['nav-menu-settings'] }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarSettings">
                                    <a id="nav-menu-users" class="dropdown-item" href="/set/users">{{ $interface['nav-menu']['nav-menu-users'] }}</a>
                                </div>
                            </li>
                        @elseif(Auth::user()->access == 3)
                            <li class="nav-item dropdown">
                                <a id="nav-menu-settings" class="nav-link dropdown-toggle" href="#" id="navbarSettings" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $interface['nav-menu']['nav-menu-settings'] }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarSettings">
                                    <a id="nav-menu-users" class="dropdown-item" href="/set/users">{{ $interface['nav-menu']['nav-menu-users'] }}</a>
                                </div>
                            </li>
                        @endif
                        </ul>
                    @endguest
                    