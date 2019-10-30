@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\AccrualTimesheets $menu, $title, $accrualTimesheetsList */
        $accruals = "";
        $accounts = "";
        $baseTimesheets = "";
        $objects = "";
        $years = "";
        $months = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($accrualTimesheetsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="7">Месяц учета</th>
                        <th class="align-middle" scope="col">Год учета</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.accrual-timesheets.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($accrualTimesheetsList as $accrualTimesheetsRow)
                        @if ($accruals != $accrualTimesheetsRow->accrual)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em> {{ $accrualTimesheetsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($accounts != $accrualTimesheetsRow->account)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>  {{ $accrualTimesheetsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($baseTimesheets != $accrualTimesheetsRow->base_timesheet)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>   {{ $accrualTimesheetsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($objects != $accrualTimesheetsRow->object)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>    {{ $accrualTimesheetsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($years != $accrualTimesheetsRow->year)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>     {{ $accrualTimesheetsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($months != $accrualTimesheetsRow->month)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>      {{ $accrualTimesheetsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $accrualTimesheetsRow->days }}</td>
                            <td>{{ $accrualTimesheetsRow->hours }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('acc.accrual-timesheets.destroy', $accrualTimesheetsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.accrual-timesheets.show', $accrualTimesheetsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.accrual-timesheets.edit', $accrualTimesheetsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $accruals = $accrualTimesheetsRow->accrual;
                            $accounts = $accrualTimesheetsRow->account;
                            $baseTimesheets = $accrualTimesheetsRow->base_timesheet;
                            $objects = $accrualTimesheetsRow->object;
                            $years = $accrualTimesheetsRow->year;
                            $months = $accrualTimesheetsRow->month;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.accrual-timesheets.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection