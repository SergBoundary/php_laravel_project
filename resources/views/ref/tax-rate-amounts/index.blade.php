@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\TaxRateAmounts $menu, $title, $taxRateAmountsList */
        $taxRates = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($taxRateAmountsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="2">Дата начала действия ставки</th>
                        <th class="align-middle" scope="col">Сумма начала действия ставки</th>
                        <th class="align-middle" scope="col">Сумма окончания действия ставки</th>
                        <th class="align-middle" scope="col">Сумма к проценту налога</th>
                        <th class="align-middle" scope="col">Процент налога</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.tax-rate-amounts.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($taxRateAmountsList as $taxRateAmountsRow)
                        @if ($taxRates != $taxRateAmountsRow->tax_rate)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em> {{ $taxRateAmountsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td>{{ $taxRateAmountsRow->date_from }}</td>
                            <td>{{ $taxRateAmountsRow->amount_from }}</td>
                            <td>{{ $taxRateAmountsRow->amount_to }}</td>
                            <td>{{ $taxRateAmountsRow->amount }}</td>
                            <td>{{ $taxRateAmountsRow->percent }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.tax-rate-amounts.destroy', $taxRateAmountsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.tax-rate-amounts.show', $taxRateAmountsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.tax-rate-amounts.edit', $taxRateAmountsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $taxRates = $taxRateAmountsRow->tax_rate;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.tax-rate-amounts.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection