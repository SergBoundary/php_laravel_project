@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\VacationAmounts $menu, $title, $vacationAmountsList */
        $personalCards = "";
        $vacations = "";
        $accruals = "";
        $accounts = "";
        $years = "";
        $months = "";
        $years = "";
        $months = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($vacationAmountsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="9">Расчет от даты</th>
                        <th class="align-middle" scope="col">Расчет до даты</th>
                        <th class="align-middle" scope="col">Сумма всего</th>
                        <th class="align-middle" scope="col">Процент оплаты</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.vacation-amounts.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($vacationAmountsList as $vacationAmountsRow)
                        @if ($personalCards != $vacationAmountsRow->personal_card)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em> {{ $vacationAmountsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($vacations != $vacationAmountsRow->vacation)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>  {{ $vacationAmountsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($accruals != $vacationAmountsRow->accrual)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>   {{ $vacationAmountsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($accounts != $vacationAmountsRow->account)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>    {{ $vacationAmountsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($years != $vacationAmountsRow->year)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>     {{ $vacationAmountsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($months != $vacationAmountsRow->month)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>      {{ $vacationAmountsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($years != $vacationAmountsRow->calculation_year)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>       {{ $vacationAmountsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($months != $vacationAmountsRow->calculation_month)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>        {{ $vacationAmountsRow->country }}</em></td>
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
                            <td>{{ $vacationAmountsRow->date_from }}</td>
                            <td>{{ $vacationAmountsRow->date_to }}</td>
                            <td>{{ $vacationAmountsRow->amount_total }}</td>
                            <td>{{ $vacationAmountsRow->percent }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('acc.vacation-amounts.destroy', $vacationAmountsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.vacation-amounts.show', $vacationAmountsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.vacation-amounts.edit', $vacationAmountsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $vacationAmountsRow->personal_card;
                            $vacations = $vacationAmountsRow->vacation;
                            $accruals = $vacationAmountsRow->accrual;
                            $accounts = $vacationAmountsRow->account;
                            $years = $vacationAmountsRow->year;
                            $months = $vacationAmountsRow->month;
                            $years = $vacationAmountsRow->calculation_year;
                            $months = $vacationAmountsRow->calculation_month;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.vacation-amounts.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection