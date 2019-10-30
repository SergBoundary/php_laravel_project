@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\EmployeeAccrualMonths $menu, $title, $employeeAccrualMonthsList */
        $years = "";
        $months = "";
        $departments = "";
        $positions = "";
        $objects = "";
        $teams = "";
        $personalCards = "";
        $accruals = "";
        $employmentTypes = "";
        $years = "";
        $months = "";
        $accounts = "";
        $taxScales = "";
        $currencies = "";
        $currencyKurses = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($employeeAccrualMonthsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.employee-accrual-months.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($employeeAccrualMonthsList as $employeeAccrualMonthsRow)
                        @if ($years != $employeeAccrualMonthsRow->calculation_year)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em> {{ $employeeAccrualMonthsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($months != $employeeAccrualMonthsRow->calculation_month)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>  {{ $employeeAccrualMonthsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($departments != $employeeAccrualMonthsRow->department)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>   {{ $employeeAccrualMonthsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($positions != $employeeAccrualMonthsRow->position)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>    {{ $employeeAccrualMonthsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($objects != $employeeAccrualMonthsRow->object)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>     {{ $employeeAccrualMonthsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($teams != $employeeAccrualMonthsRow->team)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>      {{ $employeeAccrualMonthsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($personalCards != $employeeAccrualMonthsRow->personal_card)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>       {{ $employeeAccrualMonthsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($accruals != $employeeAccrualMonthsRow->accrual)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>        {{ $employeeAccrualMonthsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($employmentTypes != $employeeAccrualMonthsRow->employment_type)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>         {{ $employeeAccrualMonthsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($years != $employeeAccrualMonthsRow->year)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>          {{ $employeeAccrualMonthsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($months != $employeeAccrualMonthsRow->month)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>           {{ $employeeAccrualMonthsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($accounts != $employeeAccrualMonthsRow->account)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>            {{ $employeeAccrualMonthsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($taxScales != $employeeAccrualMonthsRow->tax_scale)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>             {{ $employeeAccrualMonthsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($currencies != $employeeAccrualMonthsRow->currency)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>              {{ $employeeAccrualMonthsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($currencyKurses != $employeeAccrualMonthsRow->currency_kurs)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>               {{ $employeeAccrualMonthsRow->country }}</em></td>
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
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('acc.employee-accrual-months.destroy', $employeeAccrualMonthsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.employee-accrual-months.show', $employeeAccrualMonthsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.employee-accrual-months.edit', $employeeAccrualMonthsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $years = $employeeAccrualMonthsRow->calculation_year;
                            $months = $employeeAccrualMonthsRow->calculation_month;
                            $departments = $employeeAccrualMonthsRow->department;
                            $positions = $employeeAccrualMonthsRow->position;
                            $objects = $employeeAccrualMonthsRow->object;
                            $teams = $employeeAccrualMonthsRow->team;
                            $personalCards = $employeeAccrualMonthsRow->personal_card;
                            $accruals = $employeeAccrualMonthsRow->accrual;
                            $employmentTypes = $employeeAccrualMonthsRow->employment_type;
                            $years = $employeeAccrualMonthsRow->year;
                            $months = $employeeAccrualMonthsRow->month;
                            $accounts = $employeeAccrualMonthsRow->account;
                            $taxScales = $employeeAccrualMonthsRow->tax_scale;
                            $currencies = $employeeAccrualMonthsRow->currency;
                            $currencyKurses = $employeeAccrualMonthsRow->currency_kurs;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.employee-accrual-months.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection