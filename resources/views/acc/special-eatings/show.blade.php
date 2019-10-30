@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\SpecialEatings $menu, $title, $specialEatingsList */
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
                                    <label for='personal_card'>Работник</label>
                                    <input name='personal_card' value='{{ $specialEatingsList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='year'>Год расхода</label>
                                    <input name='year' value='{{ $specialEatingsList->year }}' id='year' type='text' maxlength="50" readonly class="form-control" title='Год расхода'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='month'>Месяц расхода</label>
                                    <input name='month' value='{{ $specialEatingsList->month }}' id='month' type='text' maxlength="50" readonly class="form-control" title='Месяц расхода'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='residual_amount'>Остаток суммы на начало месяца</label>
                                    <input name='residual_amount' value='{{ $specialEatingsList->residual_amount }}' id='residual_amount' type='text' maxlength="50" readonly class="form-control" title='Остаток суммы на начало месяца'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount'>Сумма затрат</label>
                                    <input name='amount' value='{{ $specialEatingsList->amount }}' id='amount' type='text' maxlength="50" readonly class="form-control" title='Сумма затрат'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hours'>Отработано часов за месяц</label>
                                    <input name='hours' value='{{ $specialEatingsList->hours }}' id='hours' type='text' maxlength="50" readonly class="form-control" title='Отработано часов за месяц'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='unit_price'>Цена питания за штуку</label>
                                    <input name='unit_price' value='{{ $specialEatingsList->unit_price }}' id='unit_price' type='text' maxlength="50" readonly class="form-control" title='Цена питания за штуку'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='unit_quantity'>Положеное количество за месяц</label>
                                    <input name='unit_quantity' value='{{ $specialEatingsList->unit_quantity }}' id='unit_quantity' type='text' maxlength="50" readonly class="form-control" title='Положеное количество за месяц'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('acc.special-eatings.destroy', $specialEatingsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.special-eatings.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.special-eatings.edit', $specialEatingsList->id) }}">{{ __('Изменить') }}</a>
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