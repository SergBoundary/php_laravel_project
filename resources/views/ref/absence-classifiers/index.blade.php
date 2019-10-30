@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\AbsenceClassifiers $menu, $title, $absenceClassifiersList */
        $accruals = "";
        $groupingTypesOfAbsences = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($absenceClassifiersList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="3">Название причины невыхода</th>
                        <th class="align-middle" scope="col">Код невыхода</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.absence-classifiers.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($absenceClassifiersList as $absenceClassifiersRow)
                        @if ($accruals != $absenceClassifiersRow->accrual)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em> {{ $absenceClassifiersRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($groupingTypesOfAbsences != $absenceClassifiersRow->absences_grouping)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>  {{ $absenceClassifiersRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td>{{ $absenceClassifiersRow->title }}</td>
                            <td>{{ $absenceClassifiersRow->abbr }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.absence-classifiers.destroy', $absenceClassifiersRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.absence-classifiers.show', $absenceClassifiersRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.absence-classifiers.edit', $absenceClassifiersRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $accruals = $absenceClassifiersRow->accrual;
                            $groupingTypesOfAbsences = $absenceClassifiersRow->absences_grouping;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.absence-classifiers.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection