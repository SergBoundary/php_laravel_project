@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Settings\Users $menu, $title, $usersList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{ $title }}</small></h3><br />
                @if(count($usersList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Табельный номер</th>
                        <th class="align-middle" scope="col">Работник</th>
                        <th class="align-middle" scope="col">Доступ</th>
                        <th scope="col">
                            @if ($access == 2)
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('set.users.create') }}"><img src="/img/add_black_18dp.png" alt="Добавить" title="Добавить"></a>
                            @endif
                        </th>
                    </thead>
                    <tbody>
                        @foreach($usersList as $usersRow)
                        <tr>
                            <td>{{ $usersRow->personal_account }}</td>
                            <td>{{ $usersRow->name }}</td>
                            <td>
                                @if ($usersRow->access == 0)
                                    <span class="text-secondary">Администратор</span>
                                @elseif ($usersRow->access == 1)
                                    <span class="text-danger">Руководитель</span>
                                @elseif ($usersRow->access == 2)
                                    <span class="text-success">Специалист</span>
                                @elseif ($usersRow->access == 3)
                                    <span class="text-primary">Менеджер</span>
                                @elseif ($usersRow->access == 4)
                                    <span class="text-dark">Работник</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    @if ($access == 2)
                                    <form method="POST" action="{{ route('set.users.destroy', $usersRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('set.users.show', $usersRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('set.users.edit', $usersRow->id) }}"><img src="/img/edit_black_18dp.png" alt="Изменить" title="Изменить"></a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#"><img src="/img/delete_black_18dp.png" alt="Удалить" title="Удалить"></button>
                                    </form>
                                    @endif
                                    @if ($access == 1)
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('set.users.show', $usersRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('set.users.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection