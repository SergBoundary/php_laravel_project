                    <!-- Left Side Of Navbar Menu-->
                    @guest
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <span class="navbar-text">SK-BUD</span>
                            </li>
                        </ul>
                    @else
                        <ul class="navbar-nav mr-auto">
                        @if(Auth::user()->access == 0)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarHumanResources" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Кадры
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarHumanResources">
                                    <a class="dropdown-item" href="/hr/personal-cards">Кадровый ресурс</a>
                                    <a class="dropdown-item" href="/hr/manning-orders">Назначения</a>
                                    <a class="dropdown-item" href="/hr/teams">Бригады</a>
                                    <a class="dropdown-item" href="/hr/allocations">Перемещения</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/hr/hr-analytics">Аналитика</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarAccounting" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Финансы
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarAccounting">
                                    <a class="dropdown-item" href="/acc/pieceworks">Сдельная работа</a>
                                    <a class="dropdown-item" href="/acc/base-timesheets">Повременная работа</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/acc/accruals">Начисления</a>
                                    <a class="dropdown-item" href="/acc/retentions">Удержания</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/calc/payrolls">Расчетная ведомость</a>
                                    <a class="dropdown-item" href="/calc/paychecks">Расчетный лист</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/calc/fin-analytics">Аналитика</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarReferences" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Справочники
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarReferences">
                                    <a class="dropdown-item" href="/ref/objects">Объекты</a>
                                    <a class="dropdown-item" href="/ref/departments">Подразделения</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/ref/position-professions">Классификатор профессий</a>
                                    <a class="dropdown-item" href="/ref/positions">Должности</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/ref/accrual-types">Классификатор начислений</a>
                                    <a class="dropdown-item" href="/ref/retention-types">Классификатор удержаний</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarSettings" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Настройки
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarSettings">
                                    <a class="dropdown-item" href="/set/users">Пользователи</a>
                                    <a class="dropdown-item" href="/set/menus">Меню</a>
                                </div>
                            </li>
                        @elseif(Auth::user()->access == 1)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarHumanResources" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Кадры
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarHumanResources">
                                    <a class="dropdown-item" href="/hr/personal-cards">Кадровый ресурс</a>
                                    <a class="dropdown-item" href="/hr/manning-orders">Назначения</a>
                                    <a class="dropdown-item" href="/hr/teams">Бригады</a>
                                    <a class="dropdown-item" href="/hr/allocations">Перемещения</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/hr/hr-analytics">Аналитика</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarAccounting" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Финансы
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarAccounting">
                                    <a class="dropdown-item" href="/acc/pieceworks">Сдельная работа</a>
                                    <a class="dropdown-item" href="/acc/base-timesheets">Повременная работа</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/acc/accruals">Начисления</a>
                                    <a class="dropdown-item" href="/acc/retentions">Удержания</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/calc/payrolls">Расчетная ведомость</a>
                                    <a class="dropdown-item" href="/calc/paychecks">Расчетный лист</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/calc/fin-analytics">Аналитика</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarReferences" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Справочники
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarReferences">
                                    <a class="dropdown-item" href="/ref/objects">Объекты</a>
                                    <a class="dropdown-item" href="/ref/departments">Подразделения</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/ref/position-professions">Классификатор профессий</a>
                                    <a class="dropdown-item" href="/ref/positions">Должности</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/ref/accrual-types">Классификатор начислений</a>
                                    <a class="dropdown-item" href="/ref/retention-types">Классификатор удержаний</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarSettings" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Настройки
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarSettings">
                                    <a class="dropdown-item" href="/set/users">Пользователи</a>
                                    <a class="dropdown-item" href="/set/menus">Меню</a>
                                </div>
                            </li>
                        @elseif(Auth::user()->access == 2)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarHumanResources" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Кадры
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarHumanResources">
                                    <a class="dropdown-item" href="/hr/personal-cards">Кадровый ресурс</a>
                                    <a class="dropdown-item" href="/hr/manning-orders">Назначения</a>
                                    <a class="dropdown-item" href="/hr/teams">Бригады</a>
                                    <a class="dropdown-item" href="/hr/allocations">Перемещения</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/hr/hr-analytics">Аналитика</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarAccounting" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Финансы
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarAccounting">
                                    <a class="dropdown-item" href="/acc/pieceworks">Сдельная работа</a>
                                    <a class="dropdown-item" href="/acc/base-timesheets">Повременная работа</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/acc/accruals">Начисления</a>
                                    <a class="dropdown-item" href="/acc/retentions">Удержания</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/calc/payrolls">Расчетная ведомость</a>
                                    <a class="dropdown-item" href="/calc/paychecks">Расчетный лист</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarReferences" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Справочники
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarReferences">
                                    <a class="dropdown-item" href="/ref/objects">Объекты</a>
                                    <a class="dropdown-item" href="/ref/departments">Подразделения</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/ref/position-professions">Классификатор профессий</a>
                                    <a class="dropdown-item" href="/ref/positions">Должности</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/ref/accrual-types">Классификатор начислений</a>
                                    <a class="dropdown-item" href="/ref/retention-types">Классификатор удержаний</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarSettings" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Настройки
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarSettings">
                                    <a class="dropdown-item" href="/set/users">Пользователи</a>
                                </div>
                            </li>
                        @elseif(Auth::user()->access == 3)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarHumanResources" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Кадры
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarHumanResources">
                                    <a class="dropdown-item" href="/hr/personal-cards">Кадровый ресурс</a>
                                    <a class="dropdown-item" href="/hr/manning-orders">Назначения</a>
                                    <a class="dropdown-item" href="/hr/teams">Бригады</a>
                                    <a class="dropdown-item" href="/hr/allocations">Перемещения</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarAccounting" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Финансы
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarAccounting">
                                    <a class="dropdown-item" href="/acc/pieceworks">Сдельная работа</a>
                                    <a class="dropdown-item" href="/acc/base-timesheets">Повременная работа</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/acc/accruals">Начисления</a>
                                    <a class="dropdown-item" href="/acc/retentions">Удержания</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/calc/payrolls">Расчетная ведомость</a>
                                    <a class="dropdown-item" href="/calc/paychecks">Расчетный лист</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarReferences" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Справочники
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarReferences">
                                    <a class="dropdown-item" href="/ref/objects">Объекты</a>
                                    <a class="dropdown-item" href="/ref/departments">Подразделения</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/ref/position-professions">Классификатор профессий</a>
                                    <a class="dropdown-item" href="/ref/positions">Должности</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/ref/accrual-types">Классификатор начислений</a>
                                    <a class="dropdown-item" href="/ref/retention-types">Классификатор удержаний</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarSettings" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Настройки
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarSettings">
                                    <a class="dropdown-item" href="/set/users">Пользователи</a>
                                </div>
                            </li>
                        @elseif(Auth::user()->access == 4)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarHumanResources" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Кадры
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarHumanResources">
                                    <a class="dropdown-item" href="/hr/manning-orders">Назначения</a>
                                    <a class="dropdown-item" href="/hr/teams">Бригады</a>
                                    <a class="dropdown-item" href="/hr/allocations">Перемещения</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarAccounting" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Финансы
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarAccounting">
                                    <a class="dropdown-item" href="/acc/pieceworks">Сдельная работа</a>
                                    <a class="dropdown-item" href="/acc/base-timesheets">Повременная работа</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/acc/accruals">Начисления</a>
                                    <a class="dropdown-item" href="/acc/retentions">Удержания</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/calc/paychecks">Расчетный лист</a>
                                </div>
                            </li>
                        @endif
                        </ul>
                    @endguest
                    