@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\TaxRateAmounts $menu, $title, $taxRateAmountsList
         * @var \Illuminate\Database\Eloquent $taxRatesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.tax-rate-amounts.update', $taxRateAmountsList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('ref.tax-rate-amounts.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='tax_rate_id'>Ставка налогообложения</label>
                                    <div class="input-group mb-3"
>                                        <select name='tax_rate_id' value='{{ $taxRateAmountsList->tax_rates_id }}' id='tax_rate_id' type='text' placeholder="Ставка налогообложения" class="form-control" title='Ставка налогообложения' required>
                                            @foreach($taxRatesList as $taxRatesOption)
                                            <option value="{{ $tax_ratesOption->id }}" 
                                                @if($taxRatesOption->id == $taxRateAmountsList->tax_rate_id) selected @endif>
                                                {{ $taxRatesOption->tax_rate }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.tax-rates.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_from'>Дата начала действия ставки</label>
                                    <input name='date_from' value='{{ $taxRateAmountsList->date_from }}' id='date_from' type='text' maxlength="50" class="form-control" title='Дата начала действия ставки'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount_from'>Сумма начала действия ставки</label>
                                    <input name='amount_from' value='{{ $taxRateAmountsList->amount_from }}' id='amount_from' type='text' maxlength="50" class="form-control" title='Сумма начала действия ставки'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount_to'>Сумма окончания действия ставки</label>
                                    <input name='amount_to' value='{{ $taxRateAmountsList->amount_to }}' id='amount_to' type='text' maxlength="50" class="form-control" title='Сумма окончания действия ставки'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount'>Сумма к проценту налога</label>
                                    <input name='amount' value='{{ $taxRateAmountsList->amount }}' id='amount' type='text' maxlength="50" class="form-control" title='Сумма к проценту налога'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='percent'>Процент налога</label>
                                    <input name='percent' value='{{ $taxRateAmountsList->percent }}' id='percent' type='text' maxlength="50" class="form-control" title='Процент налога'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.tax-rate-amounts.show', $taxRateAmountsList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.tax-rate-amounts.show', $taxRateAmountsList->id) }}">{{ __('Отмена') }}</a>
                                    @endif
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection