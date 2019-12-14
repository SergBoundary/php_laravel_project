@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Settings\Users $menu, $title, $usersList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row col-md-12" style="margin-bottom: -10px">
                            <div class="mr-auto">
                                <h3>{{ $title }}</h3>
                            </div>
                            <div class="ml-auto">
                                @if ($access == 2)
                                <form name="delete" method="POST" action="{{ route('set.users.destroy', $usersList->id) }}">
                                    <div class="form-row">
                                        <div class='form-group col-md-auto'>
                                            @method('DELETE')
                                            @csrf
                                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('set.users.index') }}"><img src="/img/visibility_off_black_18dp.png" alt="Закрыть" title="Закрыть"></a>
                                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('set.users.edit', $usersList->id) }}"><img src="/img/edit_black_18dp.png" alt="Изменить" title="Изменить"></a>
                                            <button type="submit" class="btn btn-outline-danger btn-sm" href="#"><img src="/img/delete_black_18dp.png" alt="Удалить" title="Удалить"></button>
                                        </div>
                                    </div>
                                </form>
                                @endif
                                @if ($access == 1)
                                <div class="form-row">
                                    <div class='form-group col-md-auto'>
                                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('set.users.index') }}"><img src="/img/visibility_off_black_18dp.png" alt="Закрыть" title="Закрыть"></a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('hr.personal-cards.includes.result_messages')

                        <form name="show">
                            <div class="row justify-content-center">
                                <div class='media form-group col-md-11'>
                                    <div>
                                        <input name='photo_url' value='{{ $usersList->photo_url }}' src="{{ $usersList->photo_url }}" id='photo_url' type='image' class="img-thumbnail mr-3" height="180" width="180">
                                    </div>
                                    <div class="media-body">
                                        <div class='form-row'>
                                            <div class="col-md-12">
                                                <label for='name' class="col-form-label col-form-label-sm">Пользователь</label>
                                                <input name='name' value='{{ $usersList->name }}' id='name' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Пользователь'>
                                            </div>
                                        </div>
                                        <div class='form-row'>
                                            <div class="col-md-4">
                                                <label for='personal_account' class="col-form-label col-form-label-sm">Табельный номер</label>
                                                <input name='personal_account' value='{{ $usersList->personal_account }}' id='personal_account' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Табельный номер'>
                                            </div>
                                            <div class="col-md-4">
                                                @if ($usersList->access == 0)
                                                        @php $access = "Администратор" @endphp
                                                @elseif ($usersList->access == 1)
                                                        @php $access = "Руководитель" @endphp
                                                @elseif ($usersList->access == 2)
                                                        @php $access = "Специалист" @endphp
                                                @elseif ($usersList->access == 3)
                                                        @php $access = "Менеджер" @endphp
                                                @elseif ($usersList->access == 4)
                                                        @php $access = "Работник" @endphp
                                                @endif
                                                <label for='access' class="col-form-label col-form-label-sm">Уровень доступа</label>
                                                <input name='access' value='{{ $access }}' id='access' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Уровень доступа'>
                                            </div>
                                            <div class='col-md-4'>
                                                <label for='created_at' class="col-form-label col-form-label-sm">Аккаунт создан</label>
                                                <input name='created_at' value='{{ $usersList->created_at }}' id='created_at' type='datetime' maxlength="50" readonly class="form-control form-control-sm" title='Аккаунт создан'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class='col-md-8'>
                                                <label for='email' class="col-form-label col-form-label-sm">Email</label>
                                                <input name='email' value='{{ $usersList->email }}' id='email' type='email' readonly class="form-control form-control-sm" size="100" title='Email'>
                                            </div>
                                            <div class='col-md-4'>
                                                <label for='email_verified_at' class="col-form-label col-form-label-sm">Email подтвержден</label>
                                                <input name='email_verified_at' value='{{ $usersList->email_verified_at }}' id='email_verified_at' type='datetime' maxlength="50" readonly class="form-control form-control-sm" title='Email подтвержден'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection