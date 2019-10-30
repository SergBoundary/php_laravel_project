@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\BaseTimesheets $menu, $title, $baseTimesheetsList */
        $personalCards = "";
        $years = "";
        $months = "";
        $accruals = "";
        $hoursBalanceClassifiers = "";
        $departments = "";
        $accounts = "";
        $positions = "";
        $objects = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($baseTimesheetsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="10">Отработано фактических дней</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.base-timesheets.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($baseTimesheetsList as $baseTimesheetsRow)
                        @if ($personalCards != $baseTimesheetsRow->personal_card)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em> {{ $baseTimesheetsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($years != $baseTimesheetsRow->year)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>  {{ $baseTimesheetsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($months != $baseTimesheetsRow->month)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>   {{ $baseTimesheetsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($accruals != $baseTimesheetsRow->accrual)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>    {{ $baseTimesheetsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($hoursBalanceClassifiers != $baseTimesheetsRow->hours_balance_classifier)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>     {{ $baseTimesheetsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($departments != $baseTimesheetsRow->department)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>      {{ $baseTimesheetsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($accounts != $baseTimesheetsRow->account)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>       {{ $baseTimesheetsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($positions != $baseTimesheetsRow->position)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>        {{ $baseTimesheetsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($objects != $baseTimesheetsRow->object)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>         {{ $baseTimesheetsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $baseTimesheetsRow->actual_days }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('acc.base-timesheets.destroy', $baseTimesheetsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.base-timesheets.show', $baseTimesheetsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.base-timesheets.edit', $baseTimesheetsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $baseTimesheetsRow->personal_card;
                            $years = $baseTimesheetsRow->year;
                            $months = $baseTimesheetsRow->month;
                            $accruals = $baseTimesheetsRow->accrual;
                            $hoursBalanceClassifiers = $baseTimesheetsRow->hours_balance_classifier;
                            $departments = $baseTimesheetsRow->department;
                            $accounts = $baseTimesheetsRow->account;
                            $positions = $baseTimesheetsRow->position;
                            $objects = $baseTimesheetsRow->object;
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