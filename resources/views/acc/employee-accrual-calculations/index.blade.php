@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\EmployeeAccrualCalculations $menu, $title, $employeeAccrualCalculationsList */
        $objects = "";
        $personalCards = "";
        $accruals = "";
        $algorithms = "";
        $taxRates = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($employeeAccrualCalculationsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="6">Сумма начисления</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.employee-accrual-calculations.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($employeeAccrualCalculationsList as $employeeAccrualCalculationsRow)
                        @if ($objects != $employeeAccrualCalculationsRow->object)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em> {{ $employeeAccrualCalculationsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($personalCards != $employeeAccrualCalculationsRow->personal_card)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>  {{ $employeeAccrualCalculationsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($accruals != $employeeAccrualCalculationsRow->accrual)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>   {{ $employeeAccrualCalculationsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($algorithms != $employeeAccrualCalculationsRow->algorithm)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>    {{ $employeeAccrualCalculationsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($taxRates != $employeeAccrualCalculationsRow->tax)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>     {{ $employeeAccrualCalculationsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $employeeAccrualCalculationsRow->accrual_amount }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('acc.employee-accrual-calculations.destroy', $employeeAccrualCalculationsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.employee-accrual-calculations.show', $employeeAccrualCalculationsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.employee-accrual-calculations.edit', $employeeAccrualCalculationsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $objects = $employeeAccrualCalculationsRow->object;
                            $personalCards = $employeeAccrualCalculationsRow->personal_card;
                            $accruals = $employeeAccrualCalculationsRow->accrual;
                            $algorithms = $employeeAccrualCalculationsRow->algorithm;
                            $taxRates = $employeeAccrualCalculationsRow->tax;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.employee-accrual-calculations.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection