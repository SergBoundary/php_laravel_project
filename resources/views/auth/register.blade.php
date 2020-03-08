@extends('layouts.app')

@section('content')
<div id="interface-modul" modul="form-registration"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="card">
                    <h4 id="form-registration-title" class="card-header">{{ $interface['form-registration']['form-registration-title'] }}</h4>
                    
                    <div class="card-body">

                        <br><input id="language" type="hidden" name="language" value="{{ $interface['language'] }}">
                        <input id="structura" type="hidden" name="structura" value="{{ $login }}">
                        
                        <div class="form-group row">
                            <label id="form-registration-package" for="package" class="col-md-4 col-form-label text-md-right">{{ $interface['form-registration']['form-registration-package'] }}</label>

                            <div class="col-md-4">
                                <select name='package' id='package' type='text' class="form-control @error('sex') is-invalid @enderror" title="{{ $interface['form-registration']['form-registration-package'] }}" required>
                                    <option id="service-package-zero" value="0" selected>{{ $interface['service-package']['service-package-zero'] }}</option>
                                    <option id="service-package-first" value="1">{{ $interface['service-package']['service-package-first'] }}</option>
                                    <option id="service-package-unlimited" value="2">{{ $interface['service-package']['service-package-unlimited'] }}</option>
                                </select>

                                @error('package')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div><hr>

                        <div class="form-group row">
                            <label id="form-registration-name" for="name" class="col-md-4 col-form-label text-md-right">{{ $interface['form-registration']['form-registration-name'] }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control user-name @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label id="form-registration-surname" for="surname" class="col-md-4 col-form-label text-md-right">{{ $interface['form-registration']['form-registration-surname'] }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control user-name @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label id="form-registration-sex" for="sex" class="col-md-4 col-form-label text-md-right">{{ $interface['form-registration']['form-registration-sex'] }}</label>

                            <div class="col-md-4">
                                <select name='sex' id='sex' type='text' class="form-control @error('sex') is-invalid @enderror" title="{{ $interface['form-registration']['form-registration-sex'] }}" required>
                                    <option id="user-sex-female" value="F">{{ $interface['user-sex']['user-sex-female'] }}</option>
                                    <option id="user-sex-male" value="M">{{ $interface['user-sex']['user-sex-male'] }}</option>
                                    <option id="user-sex-undefined" value="X" selected>{{ $interface['user-sex']['user-sex-undefined'] }}</option>
                                </select>

                                @error('sex')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label id="form-registration-birth-date" for="born_date" class="col-md-4 col-form-label text-md-right">{{ $interface['form-registration']['form-registration-birth-date'] }}</label>

                            <div class="col-md-4">
                                <input id="born_date" type="date" class="form-control @error('born_date') is-invalid @enderror" name="born_date" value="{{ old('born_date') }}" required autocomplete="born_date" autofocus>

                                @error('born_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label id="form-registration-phone" for="phone" class="col-md-4 col-form-label text-md-right">{{ $interface['form-registration']['form-registration-phone'] }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label id="form-registration-email" for="email" class="col-md-4 col-form-label text-md-right">{{ $interface['form-registration']['form-registration-email'] }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div><hr>

                        <div class="form-group row">
                            <label id="form-registration-login" for="login" class="col-md-4 col-form-label text-md-right">{{ $interface['form-registration']['form-registration-login'] }}</label>

                            <div class="col-md-6">
                                <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ $login }}" required autocomplete="login" autofocus>

                                @error('login')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label id="form-registration-password" for="password" class="col-md-4 col-form-label text-md-right">{{ $interface['form-registration']['form-registration-password'] }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label id="form-registration-confirm-password" for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ $interface['form-registration']['form-registration-confirm-password'] }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="col-md-8 offset-md-4">
                            <button id="" type="submit" class="btn btn-primary">
                                {{ $interface['form-registration']['form-registration-create-account'] }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
