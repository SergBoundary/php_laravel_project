@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Settings\Users $menu, $title, $usersList */
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
                                    <label for='name'>Работник</label>
                                    <input name='name' value='{{ $usersList->name }}' id='name' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='personal_account'>Табельный номер</label>
                                    <input name='personal_account' value='{{ $usersList->personal_account }}' id='personal_account' type='text' maxlength="50" readonly class="form-control" title='Табельный номер'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='email'>E-mail</label>
                                    <input name='email' value='{{ $usersList->email }}' id='email' type='text' maxlength="50" readonly class="form-control" title='E-mail'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='email_verified_at'>Проверка E-mail</label>
                                    <input name='email_verified_at' value='{{ $usersList->email_verified_at }}' id='email_verified_at' type='text' maxlength="50" readonly class="form-control" title='Проверка E-mail'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='access'>Доступ</label>
							    	@if ($usersList->access == 0)
										@php $access = "Администратор" @endphp
									@elseif ($usersList->access == 1)
										@php $access = "Руководитель" @endphp
									@elseif ($usersList->access == 2)
										@php $access = "Менеджер" @endphp
									@elseif ($usersList->access == 3)
										@php $access = "Работник" @endphp
									@endif
                                    <input name='access' value='{{ $usersList->access }} - {{ $access }}' id='access' type='text' maxlength="50" readonly class="form-control" title='Доступ'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('set.users.destroy', $usersList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('set.users.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('set.users.edit', $usersList->id) }}">{{ __('Изменить') }}</a>
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