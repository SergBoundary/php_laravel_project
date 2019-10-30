@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\PersonalCards $menu, $title, $personalCardsList */
        $nationalities = "";
        $cities = "";
        $regions = "";
        $districts = "";
        $countries = "";
        $maritalStatuses = "";
        $clothingSizes = "";
        $shoeSizes = "";
        $disabilities = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($personalCardsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Табельный номер</th>
                        <th class="align-middle" scope="col">Фамилия</th>
                        <th class="align-middle" scope="col">Имя (первое имя)</th>
                        <th class="align-middle" scope="col">Дата рождения</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-cards.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($personalCardsList as $personalCardsRow)
                        <tr>
                            <td>{{ $personalCardsRow->personal_account }}</td>
                            <td>{{ $personalCardsRow->surname }}</td>
                            <td>{{ $personalCardsRow->first_name }}</td>
                            <td>{{ $personalCardsRow->born_date }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.personal-cards.destroy', $personalCardsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.personal-cards.show', $personalCardsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.personal-cards.edit', $personalCardsRow->id) }}">{{ __('Изменить') }}</a>
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
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-cards.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection