@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\Teams $menu, $title, $teamsList */
        $personalCards = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{ $title }}</small></h3><br />
                @if(count($teamsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Бригадир</th>
                        <th class="align-middle" scope="col">Название бригады</th>
                        <th class="align-middle" scope="col">Аббривиатура</th>
                        <th class="align-middle" scope="col">Сформирована</th>
                        <th class="align-middle" scope="col">Расформирована</th>
                        <th scope="col">
                            @if ($access == 2)
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.teams.create') }}"><img src="/img/add_black_18dp.png" alt="Добавить" title="Добавить"></a>
                            @endif
                        </th>
                    </thead>
                    <tbody>
                        @foreach($teamsList as $teamsRow)
                        <tr>
                            <td>{{ $teamsRow->personal_card }}</td>
                            <td>{{ $teamsRow->title }}</td>
                            <td>{{ $teamsRow->abbr }}</td>
                            <td>{{ $teamsRow->start }}</td>
                            <td>{{ $teamsRow->expiry }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    @if ($access == 2)
                                    <form method="POST" action="{{ route('hr.teams.destroy', $teamsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.teams.show', $teamsRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.teams.edit', $teamsRow->id) }}"><img src="/img/edit_black_18dp.png" alt="Изменить" title="Изменить"></a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#"><img src="/img/delete_black_18dp.png" alt="Удалить" title="Удалить"></button>
                                    </form>
                                    @endif
                                    @if ($access == 1)
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.teams.show', $teamsRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.teams.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection