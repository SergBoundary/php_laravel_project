@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\AbsenceFromWorks $menu, $title, $absenceFromWorksList */
        $personalCards = "";
        $absenceClassifiers = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($absenceFromWorksList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="3">Начало периода отсутствия на работе</th>
                        <th class="align-middle" scope="col">Окончание периода отсутствия на работе</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.absence-from-works.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($absenceFromWorksList as $absenceFromWorksRow)
                        @if ($personalCards != $absenceFromWorksRow->personal_card)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em> {{ $absenceFromWorksRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($absenceClassifiers != $absenceFromWorksRow->absence_classifier)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>  {{ $absenceFromWorksRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td>{{ $absenceFromWorksRow->start }}</td>
                            <td>{{ $absenceFromWorksRow->expiry }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('acc.absence-from-works.destroy', $absenceFromWorksRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.absence-from-works.show', $absenceFromWorksRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.absence-from-works.edit', $absenceFromWorksRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $absenceFromWorksRow->personal_card;
                            $absenceClassifiers = $absenceFromWorksRow->absence_classifier;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.absence-from-works.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection