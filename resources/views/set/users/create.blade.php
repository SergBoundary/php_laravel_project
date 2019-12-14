@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Settings\Users $menu, $title, $usersList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{ $title }}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('set.users.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('set.users.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='name'>Работник</label>
                                    <input name='name' id='name' type='text' maxlength="50" class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='personal_account'>Табельный номер</label>
                                    <input name='personal_account' id='personal_account' type='text' maxlength="50" class="form-control" title='Табельный номер'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='email'>E-mail</label>
                                    <input name='email' id='email' type='text' maxlength="50" class="form-control" title='E-mail'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='email_verified_at'>Проверка E-mail</label>
                                    <input name='email_verified_at' id='email_verified_at' type='text' maxlength="50" class="form-control" title='Проверка E-mail'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='password'>Пароль</label>
                                    <input name='password' id='password' type='text' maxlength="50" readonly class="form-control" title='Пароль'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='access'>Доступ</label>
                                    <input name='access' id='access' type='text' maxlength="50" class="form-control" title='Доступ'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('set.users.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('set.users.index') }}">{{ __('Отмена') }}</a>
                                    @endif
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection