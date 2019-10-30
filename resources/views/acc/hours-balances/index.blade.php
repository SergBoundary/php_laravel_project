@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\HoursBalances $menu, $title, $hoursBalancesList */
        $years = "";
        $months = "";
        $hoursBalanceClassifiers = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($hoursBalancesList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="4">Баланс дней</th>
                        <th class="align-middle" scope="col">Баланс часов</th>
                        <th class="align-middle" scope="col">Баланс выходных дней</th>
                        <th class="align-middle" scope="col">Баланс праздничных дней</th>
                        <th class="align-middle" scope="col">Баланс вечерних часов</th>
                        <th class="align-middle" scope="col">Баланс ночных часов</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.hours-balances.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($hoursBalancesList as $hoursBalancesRow)
                        @if ($years != $hoursBalancesRow->year)
                        <tr>
                            <td colspan="9" class="text-muted text-uppercase"><em> {{ $hoursBalancesRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($months != $hoursBalancesRow->month)
                        <tr>
                            <td colspan="9" class="text-muted text-uppercase"><em>  {{ $hoursBalancesRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($hoursBalanceClassifiers != $hoursBalancesRow->hours_balance_classifier)
                        <tr>
                            <td colspan="9" class="text-muted text-uppercase"><em>   {{ $hoursBalancesRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $hoursBalancesRow->balance_days }}</td>
                            <td>{{ $hoursBalancesRow->balance_hours }}</td>
                            <td>{{ $hoursBalancesRow->weekends }}</td>
                            <td>{{ $hoursBalancesRow->holidays }}</td>
                            <td>{{ $hoursBalancesRow->balance_evening }}</td>
                            <td>{{ $hoursBalancesRow->balance_night }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('acc.hours-balances.destroy', $hoursBalancesRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.hours-balances.show', $hoursBalancesRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.hours-balances.edit', $hoursBalancesRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $years = $hoursBalancesRow->year;
                            $months = $hoursBalancesRow->month;
                            $hoursBalanceClassifiers = $hoursBalancesRow->hours_balance_classifier;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.hours-balances.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection