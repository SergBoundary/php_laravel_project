@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\EmployeeAccruals $menu, $title, $employeeAccrualsList */
        $departments = "";
        $departmentAccruals = "";
        $teams = "";
        $objects = "";
        $personalCards = "";
        $years = "";
        $months = "";
        $currencyKurses = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($employeeAccrualsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="9">Сумма начисления работнику</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.employee-accruals.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($employeeAccrualsList as $employeeAccrualsRow)
                        @if ($departments != $employeeAccrualsRow->department)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em> {{ $employeeAccrualsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($departmentAccruals != $employeeAccrualsRow->department_accrual)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>  {{ $employeeAccrualsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($teams != $employeeAccrualsRow->team)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>   {{ $employeeAccrualsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($objects != $employeeAccrualsRow->object)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>    {{ $employeeAccrualsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($personalCards != $employeeAccrualsRow->personal_card)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>     {{ $employeeAccrualsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($years != $employeeAccrualsRow->year)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>      {{ $employeeAccrualsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($months != $employeeAccrualsRow->month)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>       {{ $employeeAccrualsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($currencyKurses != $employeeAccrualsRow->currency_kurs)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>        {{ $employeeAccrualsRow->country }}</em></td>
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
                            <td>{{ $employeeAccrualsRow->accrual_amount }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('acc.employee-accruals.destroy', $employeeAccrualsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.employee-accruals.show', $employeeAccrualsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.employee-accruals.edit', $employeeAccrualsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $departments = $employeeAccrualsRow->department;
                            $departmentAccruals = $employeeAccrualsRow->department_accrual;
                            $teams = $employeeAccrualsRow->team;
                            $objects = $employeeAccrualsRow->object;
                            $personalCards = $employeeAccrualsRow->personal_card;
                            $years = $employeeAccrualsRow->year;
                            $months = $employeeAccrualsRow->month;
                            $currencyKurses = $employeeAccrualsRow->currency_kurs;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.employee-accruals.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection