                    <!-- Right Side Of Navbar Login -->
                    <ul class="navbar-nav language">
                        <li class="nav-item dropdown">
                            <a id="lang-title" class="nav-link dropdown-toggle" href="#" id="navbarLanguage" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $interface['language'] }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarLanguage">
<!--                                <form method="POST">
                                @method('GET')
                                @csrf
                                    <button type="submit" class="dropdown-item lang" href="">Deutsch</button>
                                    <input name="language" type="hidden" value="1">
                                </form>-->
                                <form method="POST">
                                @method('GET')
                                @csrf
                                    <button type="submit" class="dropdown-item lang" href="">English</button>
                                    <input name="language" type="hidden" value="EN">
                                </form>
<!--                                <form method="POST">
                                @method('GET')
                                @csrf
                                    <button type="submit" class="dropdown-item lang" href="">Español</button>
                                    <input name="language" type="hidden" value="3">
                                </form>-->
<!--                                <form method="POST">
                                @method('GET')
                                @csrf
                                    <button type="submit" class="dropdown-item lang" href="">Français</button>
                                    <input name="language" type="hidden" value="4">
                                </form>-->
<!--                                <form method="POST">
                                @method('GET')
                                @csrf
                                    <button type="submit" class="dropdown-item lang" href="">Italiano</button>
                                    <input name="language" type="hidden" value="5">
                                </form>-->
                                <form method="POST">
                                @method('GET')
                                @csrf
                                    <button type="submit" class="dropdown-item lang" href="">Polski</button>
                                    <input name="language" type="hidden" value="PL">
                                </form>
<!--                                <form method="POST">
                                @method('GET')
                                @csrf
                                    <button type="submit" class="dropdown-item lang" href="">Português</button>
                                    <input name="language" type="hidden" value="7">
                                </form>-->
                                <form method="POST">
                                @method('GET')
                                @csrf
                                    <button type="submit" class="dropdown-item lang" href="">Русский</button>
                                    <input name="language" type="hidden" value="RU">
                                </form>
                                <form method="POST">
                                @method('GET')
                                @csrf
                                    <button type="submit" class="dropdown-item lang" href="">Українська</button>
                                    <input name="language" type="hidden" value="UA">
                                </form>
                            </div>
                        </li>
                    </ul>
