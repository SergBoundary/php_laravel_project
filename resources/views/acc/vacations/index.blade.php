@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\Vacations $menu, $title, $vacationsList */
        $documents = "";
        $personalCards = "";
        $absenceClassifiers = "";
        $phraseLists = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($vacationsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="5">Начало отпуска</th>
                        <th class="align-middle" scope="col">Конец отпуска</th>
                        <th class="align-middle" scope="col">Сумма отпускных или материальной помощи</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.vacations.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($vacationsList as $vacationsRow)
                        @if ($documents != $vacationsRow->document)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em> {{ $vacationsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($personalCards != $vacationsRow->personal_card)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>  {{ $vacationsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($absenceClassifiers != $vacationsRow->absence_classifier)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>   {{ $vacationsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($phraseLists != $vacationsRow->phrase_list)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>    {{ $vacationsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $vacationsRow->start }}</td>
                            <td>{{ $vacationsRow->expiry }}</td>
                            <td>{{ $vacationsRow->vacation_pay }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('acc.vacations.destroy', $vacationsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.vacations.show', $vacationsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.vacations.edit', $vacationsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $documents = $vacationsRow->document;
                            $personalCards = $vacationsRow->personal_card;
                            $absenceClassifiers = $vacationsRow->absence_classifier;
                            $phraseLists = $vacationsRow->phrase_list;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.vacations.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection