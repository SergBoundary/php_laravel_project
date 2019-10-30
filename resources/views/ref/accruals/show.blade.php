@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Accruals $menu, $title, $accrualsList */
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
                                    <label for='accrual_group'>Группа видов начислений</label>
                                    <input name='accrual_group' value='{{ $accrualsList->accrual_group }}' id='accrual_group' type='text' maxlength="50" readonly class="form-control" title='Группа видов начислений'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Код начисления/удержания</label>
                                    <input name='title' value='{{ $accrualsList->title }}' id='title' type='text' maxlength="50" readonly class="form-control" title='Код начисления/удержания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='direction'>Направление операции</label>
                                    <input name='direction' value='{{ $accrualsList->direction }}' id='direction' type='text' maxlength="50" readonly class="form-control" title='Направление операции'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='description'>Название начисления/удержания</label>
                                    <input name='description' value='{{ $accrualsList->description }}' id='description' type='text' maxlength="50" readonly class="form-control" title='Название начисления/удержания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='description_abbr'>Сокращенное наименование начисления/удержания</label>
                                    <input name='description_abbr' value='{{ $accrualsList->description_abbr }}' id='description_abbr' type='text' maxlength="50" readonly class="form-control" title='Сокращенное наименование начисления/удержания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='description_1c'>1С-название начисления/удержания</label>
                                    <input name='description_1c' value='{{ $accrualsList->description_1c }}' id='description_1c' type='text' maxlength="50" readonly class="form-control" title='1С-название начисления/удержания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='algorithm'>Алгоритм начислений/удержаний</label>
                                    <input name='algorithm' value='{{ $accrualsList->algorithm }}' id='algorithm' type='text' maxlength="50" readonly class="form-control" title='Алгоритм начислений/удержаний'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual_sum'>Количество для начисления по виду</label>
                                    <input name='accrual_sum' value='{{ $accrualsList->accrual_sum }}' id='accrual_sum' type='text' maxlength="50" readonly class="form-control" title='Количество для начисления по виду'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='income_number_8dr'>Номер дохода в 8-ДР</label>
                                    <input name='income_number_8dr' value='{{ $accrualsList->income_number_8dr }}' id='income_number_8dr' type='text' maxlength="50" readonly class="form-control" title='Номер дохода в 8-ДР'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='calculation_number'>Порядковый номер расчета</label>
                                    <input name='calculation_number' value='{{ $accrualsList->calculation_number }}' id='calculation_number' type='text' maxlength="50" readonly class="form-control" title='Порядковый номер расчета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual_amount'>Сумма по виду начисления</label>
                                    <input name='accrual_amount' value='{{ $accrualsList->accrual_amount }}' id='accrual_amount' type='text' maxlength="50" readonly class="form-control" title='Сумма по виду начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual_analytics'>Аналитический учет начисления</label>
                                    <input name='accrual_analytics' value='{{ $accrualsList->accrual_analytics }}' id='accrual_analytics' type='text' maxlength="50" readonly class="form-control" title='Аналитический учет начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='rounded amount'>Округление суммы</label>
                                    <input name='rounded amount' value='{{ $accrualsList->rounded amount }}' id='rounded amount' type='text' maxlength="50" readonly class="form-control" title='Округление суммы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='rounded result'>Округление результата</label>
                                    <input name='rounded result' value='{{ $accrualsList->rounded result }}' id='rounded result' type='text' maxlength="50" readonly class="form-control" title='Округление результата'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='account_title'>Номер бухгалтерского счета</label>
                                    <input name='account_title' value='{{ $accrualsList->account_title }}' id='account_title' type='text' maxlength="50" readonly class="form-control" title='Номер бухгалтерского счета'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('ref.accruals.destroy', $accrualsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.accruals.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.accruals.edit', $accrualsList->id) }}">{{ __('Изменить') }}</a>
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