@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\Users $menu, $title, $usersList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form name="show">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='name'>Логин</label>
                                    <input name='name' value='{{ $usersList->name }}' id='name' type='text' maxlength="50" readonly class="form-control" title='Логин'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='email'>Email</label>
                                    <input name='email' value='{{ $usersList->email }}' id='email' type='text' maxlength="50" readonly class="form-control" title='Email'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='email_verified_at'>Email подтвержден</label>
                                    <input name='email_verified_at' value='{{ $usersList->email_verified_at }}' id='email_verified_at' type='text' maxlength="50" readonly class="form-control" title='Email подтвержден'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='passwor'>Пароль</label>
                                    <input name='passwor' value='{{ $usersList->passwor }}' id='passwor' type='text' maxlength="50" readonly class="form-control" title='Пароль'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='access'>Доступ</label>
                                    <input name='access' value='{{ $usersList->access }}' id='access' type='text' maxlength="50" readonly class="form-control" title='Доступ'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.users.destroy', $usersList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.users.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.users.edit', $usersList->id) }}">{{ __('Изменить') }}</a>
                                    <button type="submit" class="btn btn-outline-danger" href="#">{{ __('Удалить') }}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection