@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\BaseTimesheets $menu, $title, $baseTimesheetsList */
        $personalCards = "";
        $years = "";
        $months = "";
        $objects = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($baseTimesheetsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="2">Год</th>
                        <th class="align-middle" scope="col">Месяц</th>
                        <th class="align-middle" scope="col">Объект</th>
                        <th class="align-middle" scope="col">Почасово</th>
                        <th class="align-middle" scope="col">Сдельно</th>
                        <th class="align-middle" scope="col">Итоговая сумма</th>
                        <th scope="col">
						    @if ($access == 2)
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.base-timesheets.create') }}"><img src="/img/add_black_18dp.png" alt="Добавить" title="Добавить"></a>
						    @endif
                        </th>
                    </thead>
                    <tbody>
                        @foreach($baseTimesheetsList as $baseTimesheetsRow)
                        @if ($personalCards != $baseTimesheetsRow->personal_card)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>{{ $baseTimesheetsRow->personal_card }}, {{ $baseTimesheetsRow->surname }} {{ $baseTimesheetsRow->first_name }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td>{{ $baseTimesheetsRow->year }}</td>
                            <td>{{ $baseTimesheetsRow->month }}</td>
                            <td>{{ $baseTimesheetsRow->object }}</td>
                            <td>{{ $baseTimesheetsRow->hourly }}</td>
                            <td>{{ $baseTimesheetsRow->piecework }}</td>
                            <td>{{ $baseTimesheetsRow->total }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    @if ($access == 2)
                                    <form method="POST" action="{{ route('acc.base-timesheets.destroy', $baseTimesheetsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.base-timesheets.show', $baseTimesheetsRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.base-timesheets.edit', $baseTimesheetsRow->id) }}"><img src="/img/edit_black_18dp.png" alt="Изменить" title="Изменить"></a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#"><img src="/img/delete_black_18dp.png" alt="Удалить" title="Удалить"></button>
                                    </form>
                                    @endif
                                    @if ($access == 1)
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.base-timesheets.show', $baseTimesheetsRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $baseTimesheetsRow->personal_card;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.base-timesheets.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection