@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\EmployeeAccrualChanges $menu, $title, $employeeAccrualChangesList */
        $algorithms = "";
        $taxRates = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($employeeAccrualChangesList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="3">Переформирование до даты</th>
                        <th class="align-middle" scope="col">Новое значение</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.employee-accrual-changes.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($employeeAccrualChangesList as $employeeAccrualChangesRow)
                        @if ($algorithms != $employeeAccrualChangesRow->algorithm)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em> {{ $employeeAccrualChangesRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($taxRates != $employeeAccrualChangesRow->tax_rates)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>  {{ $employeeAccrualChangesRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td>{{ $employeeAccrualChangesRow->date_to }}</td>
                            <td>{{ $employeeAccrualChangesRow->amount }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('acc.employee-accrual-changes.destroy', $employeeAccrualChangesRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.employee-accrual-changes.show', $employeeAccrualChangesRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.employee-accrual-changes.edit', $employeeAccrualChangesRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $algorithms = $employeeAccrualChangesRow->algorithm;
                            $taxRates = $employeeAccrualChangesRow->tax_rates;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.employee-accrual-changes.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection