@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\TaxRateAmounts $menu, $title, $taxRateAmountsList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form name="show">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='tax_rate'>Ставка налогообложения</label>
                                    <input name='tax_rate' value='{{ $taxRateAmountsList->tax_rate }}' id='tax_rate' type='text' maxlength="50" readonly class="form-control" title='Ставка налогообложения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_from'>Дата начала действия ставки</label>
                                    <input name='date_from' value='{{ $taxRateAmountsList->date_from }}' id='date_from' type='text' maxlength="50" readonly class="form-control" title='Дата начала действия ставки'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount_from'>Сумма начала действия ставки</label>
                                    <input name='amount_from' value='{{ $taxRateAmountsList->amount_from }}' id='amount_from' type='text' maxlength="50" readonly class="form-control" title='Сумма начала действия ставки'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount_to'>Сумма окончания действия ставки</label>
                                    <input name='amount_to' value='{{ $taxRateAmountsList->amount_to }}' id='amount_to' type='text' maxlength="50" readonly class="form-control" title='Сумма окончания действия ставки'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount'>Сумма к проценту налога</label>
                                    <input name='amount' value='{{ $taxRateAmountsList->amount }}' id='amount' type='text' maxlength="50" readonly class="form-control" title='Сумма к проценту налога'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='percent'>Процент налога</label>
                                    <input name='percent' value='{{ $taxRateAmountsList->percent }}' id='percent' type='text' maxlength="50" readonly class="form-control" title='Процент налога'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('ref.tax-rate-amounts.destroy', $taxRateAmountsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.tax-rate-amounts.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.tax-rate-amounts.edit', $taxRateAmountsList->id) }}">{{ __('Изменить') }}</a>
                                    <button type="submit" class="btn btn-outline-danger" href="#">{{ __('Удалить') }}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection