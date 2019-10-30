@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\Users $menu, $title, $usersList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($usersList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Логин</th>
                        <th class="align-middle" scope="col">Email</th>
                        <th class="align-middle" scope="col">Email подтвержден</th>
                        <th class="align-middle" scope="col">Доступ</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.users.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($usersList as $usersRow)
                        <tr>
                            <td>{{ $usersRow->name }}</td>
                            <td>{{ $usersRow->email }}</td>
                            <td>{{ $usersRow->email_verified_at }}</td>
                            <td>{{ $usersRow->access }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.users.destroy', $usersRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.users.show', $usersRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.users.edit', $usersRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.users.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection