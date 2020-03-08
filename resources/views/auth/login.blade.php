@extends('layouts.app')

@section('content')
<div id="interface-modul" modul="form-login"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="card">
                    <h4 id="form-login-logging-in" class="card-header">{{ $interface['form-login']['form-login-logging-in'] }}</h4>

                    <div class="card-body">

                        <div class="form-group row">
                            <label id="form-login-login" for="login" class="col-md-4 col-form-label text-md-right">{{ $interface['form-login']['form-login-login'] }}</label>

                            <div class="col-md-6">
                                <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="login" autofocus>

                                @error('login')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label id="form-login-password" for="password" class="col-md-4 col-form-label text-md-right">{{ $interface['form-login']['form-login-password'] }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label id="form-login-remember" class="form-check-label" for="remember">
                                        {{ $interface['form-login']['form-login-remember'] }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="col-md-8 offset-md-4">
                            <button id="form-login-enter" type="submit" class="btn btn-primary">
                                {{ $interface['form-login']['form-login-enter'] }}
                            </button>

                            @if (Route::has('password.request'))
                                <a id="form-login-forget" class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ $interface['form-login']['form-login-forget'] }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
