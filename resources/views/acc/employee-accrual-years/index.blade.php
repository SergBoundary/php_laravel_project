@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\EmployeeAccrualYears $menu, $title, $employeeAccrualYearsList */
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
        $accounts = "";
        $taxScales = "";
        $currencies = "";
        $currencyKurses = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($employeeAccrualYearsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.employee-accrual-years.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($employeeAccrualYearsList as $employeeAccrualYearsRow)
                        @if ($years != $employeeAccrualYearsRow->calculation_year)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em> {{ $employeeAccrualYearsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($months != $employeeAccrualYearsRow->calculation_month)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>  {{ $employeeAccrualYearsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($departments != $employeeAccrualYearsRow->department)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>   {{ $employeeAccrualYearsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($positions != $employeeAccrualYearsRow->position)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>    {{ $employeeAccrualYearsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($objects != $employeeAccrualYearsRow->object)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>     {{ $employeeAccrualYearsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($teams != $employeeAccrualYearsRow->team)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>      {{ $employeeAccrualYearsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($personalCards != $employeeAccrualYearsRow->personal_card)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>       {{ $employeeAccrualYearsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($accruals != $employeeAccrualYearsRow->accrual)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>        {{ $employeeAccrualYearsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($employmentTypes != $employeeAccrualYearsRow->employment_type)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>         {{ $employeeAccrualYearsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($years != $employeeAccrualYearsRow->year)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>          {{ $employeeAccrualYearsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($accounts != $employeeAccrualYearsRow->account)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>           {{ $employeeAccrualYearsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($taxScales != $employeeAccrualYearsRow->tax_scale)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>            {{ $employeeAccrualYearsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($currencies != $employeeAccrualYearsRow->currency)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>             {{ $employeeAccrualYearsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($currencyKurses != $employeeAccrualYearsRow->currency_kurs)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>              {{ $employeeAccrualYearsRow->country }}</em></td>
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
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('acc.employee-accrual-years.destroy', $employeeAccrualYearsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.employee-accrual-years.show', $employeeAccrualYearsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.employee-accrual-years.edit', $employeeAccrualYearsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $years = $employeeAccrualYearsRow->calculation_year;
                            $months = $employeeAccrualYearsRow->calculation_month;
                            $departments = $employeeAccrualYearsRow->department;
                            $positions = $employeeAccrualYearsRow->position;
                            $objects = $employeeAccrualYearsRow->object;
                            $teams = $employeeAccrualYearsRow->team;
                            $personalCards = $employeeAccrualYearsRow->personal_card;
                            $accruals = $employeeAccrualYearsRow->accrual;
                            $employmentTypes = $employeeAccrualYearsRow->employment_type;
                            $years = $employeeAccrualYearsRow->year;
                            $accounts = $employeeAccrualYearsRow->account;
                            $taxScales = $employeeAccrualYearsRow->tax_scale;
                            $currencies = $employeeAccrualYearsRow->currency;
                            $currencyKurses = $employeeAccrualYearsRow->currency_kurs;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.employee-accrual-years.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection