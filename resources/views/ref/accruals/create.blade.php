@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Accruals $menu, $title, $accrualsList
         * @var \Illuminate\Database\Eloquent $accrualGroupsList, $algorithmsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.accruals.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('ref.accruals.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='accrual_group_id'>Группа видов начислений</label>
                                    <div class="input-group mb-3"
>                                        <select name='accrual_group_id' value='accrual_group_id' id='accrual_group_id' type='text' placeholder="Группа видов начислений" class="form-control" title='Группа видов начислений' required>
                                            @foreach($accrualGroupsList as $accrualGroupsOption)
                                            <option value="{{ $accrual_groupsOption->id }}" >
                                                {{ $accrualGroupsOption->accrual_group }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.accrual-groups.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='algorithm_id'>Алгоритм начислений/удержаний</label>
                                    <div class="input-group mb-3"
>                                        <select name='algorithm_id' value='algorithm_id' id='algorithm_id' type='text' placeholder="Алгоритм начислений/удержаний" class="form-control" title='Алгоритм начислений/удержаний' required>
                                            @foreach($algorithmsList as $algorithmsOption)
                                            <option value="{{ $algorithmsOption->id }}" >
                                                {{ $algorithmsOption->algorithm }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.algorithms.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Код начисления/удержания</label>
                                    <input name='title' id='title' type='text' maxlength="50" class="form-control" title='Код начисления/удержания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='direction'>Направление операции</label>
                                    <input name='direction' id='direction' type='text' maxlength="50" class="form-control" title='Направление операции'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='description'>Название начисления/удержания</label>
                                    <input name='description' id='description' type='text' maxlength="50" class="form-control" title='Название начисления/удержания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='description_abbr'>Сокращенное наименование начисления/удержания</label>
                                    <input name='description_abbr' id='description_abbr' type='text' maxlength="50" class="form-control" title='Сокращенное наименование начисления/удержания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='description_1c'>1С-название начисления/удержания</label>
                                    <input name='description_1c' id='description_1c' type='text' maxlength="50" class="form-control" title='1С-название начисления/удержания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual_sum'>Количество для начисления по виду</label>
                                    <input name='accrual_sum' id='accrual_sum' type='text' maxlength="50" class="form-control" title='Количество для начисления по виду'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='income_number_8dr'>Номер дохода в 8-ДР</label>
                                    <input name='income_number_8dr' id='income_number_8dr' type='text' maxlength="50" class="form-control" title='Номер дохода в 8-ДР'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='calculation_number'>Порядковый номер расчета</label>
                                    <input name='calculation_number' id='calculation_number' type='text' maxlength="50" class="form-control" title='Порядковый номер расчета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual_amount'>Сумма по виду начисления</label>
                                    <input name='accrual_amount' id='accrual_amount' type='text' maxlength="50" class="form-control" title='Сумма по виду начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual_analytics'>Аналитический учет начисления</label>
                                    <input name='accrual_analytics' id='accrual_analytics' type='text' maxlength="50" class="form-control" title='Аналитический учет начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='rounded amount'>Округление суммы</label>
                                    <input name='rounded amount' id='rounded amount' type='text' maxlength="50" class="form-control" title='Округление суммы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='rounded result'>Округление результата</label>
                                    <input name='rounded result' id='rounded result' type='text' maxlength="50" class="form-control" title='Округление результата'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='account_title'>Номер бухгалтерского счета</label>
                                    <input name='account_title' id='account_title' type='text' maxlength="50" class="form-control" title='Номер бухгалтерского счета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.accruals.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.accruals.index') }}">{{ __('Отмена') }}</a>
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