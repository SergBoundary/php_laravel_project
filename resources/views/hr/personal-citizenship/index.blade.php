@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\PersonalCitizenship $menu, $title, $personalCitizenshipList */
        $personalCards = "";
        $countries = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($personalCitizenshipList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="3">Дата вступления</th>
                        <th class="align-middle" scope="col">Дата выхода</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-citizenship.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($personalCitizenshipList as $personalCitizenshipRow)
                        @if ($personalCards != $personalCitizenshipRow->personal_card)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em> {{ $personalCitizenshipRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($countries != $personalCitizenshipRow->country)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>  {{ $personalCitizenshipRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td>{{ $personalCitizenshipRow->start }}</td>
                            <td>{{ $personalCitizenshipRow->expiry }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.personal-citizenship.destroy', $personalCitizenshipRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.personal-citizenship.show', $personalCitizenshipRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.personal-citizenship.edit', $personalCitizenshipRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $personalCitizenshipRow->personal_card;
                            $countries = $personalCitizenshipRow->country;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-citizenship.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection