@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\BaseTimesheets $menu, $title, $baseTimesheetsList
         * @var \Illuminate\Database\Eloquent $personalCardsList, $yearsList, $monthsList, $accrualsList, $hoursBalanceClassifiersList, $departmentsList, $accountsList, $positionsList, $objectsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('acc.base-timesheets.update', $baseTimesheetsList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('acc.base-timesheets.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='personal_card_id'>Работник</label>
                                    <div class="input-group mb-3"
>                                        <select name='personal_card_id' value='{{ $baseTimesheetsList->personal_cards_id }}' id='personal_card_id' type='text' placeholder="Работник" class="form-control" title='Работник' required>
                                            @foreach($personalCardsList as $personalCardsOption)
                                            <option value="{{ $personal_cardsOption->id }}" 
                                                @if($personalCardsOption->id == $baseTimesheetsList->personal_card_id) selected @endif>
                                                {{ $personalCardsOption->personal_card }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('hr.personal-cards.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='year_id'>Год</label>
                                    <div class="input-group mb-3"
>                                        <select name='year_id' value='{{ $baseTimesheetsList->years_id }}' id='year_id' type='text' placeholder="Год" class="form-control" title='Год' required>
                                            @foreach($yearsList as $yearsOption)
                                            <option value="{{ $yearsOption->id }}" 
                                                @if($yearsOption->id == $baseTimesheetsList->year_id) selected @endif>
                                                {{ $yearsOption->year }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.years.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='month_id'>Месяц</label>
                                    <div class="input-group mb-3"
>                                        <select name='month_id' value='{{ $baseTimesheetsList->months_id }}' id='month_id' type='text' placeholder="Месяц" class="form-control" title='Месяц' required>
                                            @foreach($monthsList as $monthsOption)
                                            <option value="{{ $monthsOption->id }}" 
                                                @if($monthsOption->id == $baseTimesheetsList->month_id) selected @endif>
                                                {{ $monthsOption->month }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.months.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual_id'>Вид оплаты</label>
                                    <div class="input-group mb-3"
>                                        <select name='accrual_id' value='{{ $baseTimesheetsList->accruals_id }}' id='accrual_id' type='text' placeholder="Вид оплаты" class="form-control" title='Вид оплаты' required>
                                            @foreach($accrualsList as $accrualsOption)
                                            <option value="{{ $accrualsOption->id }}" 
                                                @if($accrualsOption->id == $baseTimesheetsList->accrual_id) selected @endif>
                                                {{ $accrualsOption->accrual }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.accruals.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hours_balance_classifier_id'>Графиков распределения рабочих часов</label>
                                    <div class="input-group mb-3"
>                                        <select name='hours_balance_classifier_id' value='{{ $baseTimesheetsList->hours_balance_classifiers_id }}' id='hours_balance_classifier_id' type='text' placeholder="Графиков распределения рабочих часов" class="form-control" title='Графиков распределения рабочих часов' required>
                                            @foreach($hoursBalanceClassifiersList as $hoursBalanceClassifiersOption)
                                            <option value="{{ $hours_balance_classifiersOption->id }}" 
                                                @if($hoursBalanceClassifiersOption->id == $baseTimesheetsList->hours_balance_classifier_id) selected @endif>
                                                {{ $hoursBalanceClassifiersOption->hours_balance_classifier }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.hours-balance-classifiers.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='department_id'>Подразделение</label>
                                    <div class="input-group mb-3"
>                                        <select name='department_id' value='{{ $baseTimesheetsList->departments_id }}' id='department_id' type='text' placeholder="Подразделение" class="form-control" title='Подразделение' required>
                                            @foreach($departmentsList as $departmentsOption)
                                            <option value="{{ $departmentsOption->id }}" 
                                                @if($departmentsOption->id == $baseTimesheetsList->department_id) selected @endif>
                                                {{ $departmentsOption->department }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.departments.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='account_id'>Номер счета для отнесения затрат</label>
                                    <div class="input-group mb-3"
>                                        <select name='account_id' value='{{ $baseTimesheetsList->accounts_id }}' id='account_id' type='text' placeholder="Номер счета для отнесения затрат" class="form-control" title='Номер счета для отнесения затрат' required>
                                            @foreach($accountsList as $accountsOption)
                                            <option value="{{ $accountsOption->id }}" 
                                                @if($accountsOption->id == $baseTimesheetsList->account_id) selected @endif>
                                                {{ $accountsOption->account }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.accounts.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='position_id'>Занимаемая должность</label>
                                    <div class="input-group mb-3"
>                                        <select name='position_id' value='{{ $baseTimesheetsList->positions_id }}' id='position_id' type='text' placeholder="Занимаемая должность" class="form-control" title='Занимаемая должность' required>
                                            @foreach($positionsList as $positionsOption)
                                            <option value="{{ $positionsOption->id }}" 
                                                @if($positionsOption->id == $baseTimesheetsList->position_id) selected @endif>
                                                {{ $positionsOption->position }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.positions.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='object_id'>Объект выполнения работ</label>
                                    <div class="input-group mb-3"
>                                        <select name='object_id' value='{{ $baseTimesheetsList->objects_id }}' id='object_id' type='text' placeholder="Объект выполнения работ" class="form-control" title='Объект выполнения работ' required>
                                            @foreach($objectsList as $objectsOption)
                                            <option value="{{ $objectsOption->id }}" 
                                                @if($objectsOption->id == $baseTimesheetsList->object_id) selected @endif>
                                                {{ $objectsOption->object }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.objects.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_1'>1</label>
                                    <input name='day_1' value='{{ $baseTimesheetsList->day_1 }}' id='day_1' type='text' maxlength="50" class="form-control" title='1'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_2'>2</label>
                                    <input name='day_2' value='{{ $baseTimesheetsList->day_2 }}' id='day_2' type='text' maxlength="50" class="form-control" title='2'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_3'>3</label>
                                    <input name='day_3' value='{{ $baseTimesheetsList->day_3 }}' id='day_3' type='text' maxlength="50" class="form-control" title='3'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_4'>4</label>
                                    <input name='day_4' value='{{ $baseTimesheetsList->day_4 }}' id='day_4' type='text' maxlength="50" class="form-control" title='4'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_5'>5</label>
                                    <input name='day_5' value='{{ $baseTimesheetsList->day_5 }}' id='day_5' type='text' maxlength="50" class="form-control" title='5'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_6'>6</label>
                                    <input name='day_6' value='{{ $baseTimesheetsList->day_6 }}' id='day_6' type='text' maxlength="50" class="form-control" title='6'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_7'>7</label>
                                    <input name='day_7' value='{{ $baseTimesheetsList->day_7 }}' id='day_7' type='text' maxlength="50" class="form-control" title='7'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_8'>8</label>
                                    <input name='day_8' value='{{ $baseTimesheetsList->day_8 }}' id='day_8' type='text' maxlength="50" class="form-control" title='8'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_9'>9</label>
                                    <input name='day_9' value='{{ $baseTimesheetsList->day_9 }}' id='day_9' type='text' maxlength="50" class="form-control" title='9'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_10'>10</label>
                                    <input name='day_10' value='{{ $baseTimesheetsList->day_10 }}' id='day_10' type='text' maxlength="50" class="form-control" title='10'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_11'>11</label>
                                    <input name='day_11' value='{{ $baseTimesheetsList->day_11 }}' id='day_11' type='text' maxlength="50" class="form-control" title='11'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_12'>12</label>
                                    <input name='day_12' value='{{ $baseTimesheetsList->day_12 }}' id='day_12' type='text' maxlength="50" class="form-control" title='12'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_13'>13</label>
                                    <input name='day_13' value='{{ $baseTimesheetsList->day_13 }}' id='day_13' type='text' maxlength="50" class="form-control" title='13'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_14'>14</label>
                                    <input name='day_14' value='{{ $baseTimesheetsList->day_14 }}' id='day_14' type='text' maxlength="50" class="form-control" title='14'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_15'>15</label>
                                    <input name='day_15' value='{{ $baseTimesheetsList->day_15 }}' id='day_15' type='text' maxlength="50" class="form-control" title='15'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_16'>16</label>
                                    <input name='day_16' value='{{ $baseTimesheetsList->day_16 }}' id='day_16' type='text' maxlength="50" class="form-control" title='16'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_17'>17</label>
                                    <input name='day_17' value='{{ $baseTimesheetsList->day_17 }}' id='day_17' type='text' maxlength="50" class="form-control" title='17'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_18'>18</label>
                                    <input name='day_18' value='{{ $baseTimesheetsList->day_18 }}' id='day_18' type='text' maxlength="50" class="form-control" title='18'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_19'>19</label>
                                    <input name='day_19' value='{{ $baseTimesheetsList->day_19 }}' id='day_19' type='text' maxlength="50" class="form-control" title='19'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_20'>20</label>
                                    <input name='day_20' value='{{ $baseTimesheetsList->day_20 }}' id='day_20' type='text' maxlength="50" class="form-control" title='20'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_21'>21</label>
                                    <input name='day_21' value='{{ $baseTimesheetsList->day_21 }}' id='day_21' type='text' maxlength="50" class="form-control" title='21'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_22'>22</label>
                                    <input name='day_22' value='{{ $baseTimesheetsList->day_22 }}' id='day_22' type='text' maxlength="50" class="form-control" title='22'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_23'>23</label>
                                    <input name='day_23' value='{{ $baseTimesheetsList->day_23 }}' id='day_23' type='text' maxlength="50" class="form-control" title='23'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_24'>24</label>
                                    <input name='day_24' value='{{ $baseTimesheetsList->day_24 }}' id='day_24' type='text' maxlength="50" class="form-control" title='24'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_25'>25</label>
                                    <input name='day_25' value='{{ $baseTimesheetsList->day_25 }}' id='day_25' type='text' maxlength="50" class="form-control" title='25'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_26'>26</label>
                                    <input name='day_26' value='{{ $baseTimesheetsList->day_26 }}' id='day_26' type='text' maxlength="50" class="form-control" title='26'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_27'>27</label>
                                    <input name='day_27' value='{{ $baseTimesheetsList->day_27 }}' id='day_27' type='text' maxlength="50" class="form-control" title='27'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_28'>28</label>
                                    <input name='day_28' value='{{ $baseTimesheetsList->day_28 }}' id='day_28' type='text' maxlength="50" class="form-control" title='28'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_29'>29</label>
                                    <input name='day_29' value='{{ $baseTimesheetsList->day_29 }}' id='day_29' type='text' maxlength="50" class="form-control" title='29'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_30'>30</label>
                                    <input name='day_30' value='{{ $baseTimesheetsList->day_30 }}' id='day_30' type='text' maxlength="50" class="form-control" title='30'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_31'>31</label>
                                    <input name='day_31' value='{{ $baseTimesheetsList->day_31 }}' id='day_31' type='text' maxlength="50" class="form-control" title='31'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount'>Размер оклада/тарифа работника</label>
                                    <input name='amount' value='{{ $baseTimesheetsList->amount }}' id='amount' type='text' maxlength="50" class="form-control" title='Размер оклада/тарифа работника'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='actual_days'>Отработано фактических дней</label>
                                    <input name='actual_days' value='{{ $baseTimesheetsList->actual_days }}' id='actual_days' type='text' maxlength="50" class="form-control" title='Отработано фактических дней'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='vacation_days'>Отпускные дни</label>
                                    <input name='vacation_days' value='{{ $baseTimesheetsList->vacation_days }}' id='vacation_days' type='text' maxlength="50" class="form-control" title='Отпускные дни'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='childbirth_leave'>Отпуск в связи с родами</label>
                                    <input name='childbirth_leave' value='{{ $baseTimesheetsList->childbirth_leave }}' id='childbirth_leave' type='text' maxlength="50" class="form-control" title='Отпуск в связи с родами'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='sick_days'>Больничные дни</label>
                                    <input name='sick_days' value='{{ $baseTimesheetsList->sick_days }}' id='sick_days' type='text' maxlength="50" class="form-control" title='Больничные дни'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='other_days'>Прочие дни разрешеные законом (оплачиваемые)</label>
                                    <input name='other_days' value='{{ $baseTimesheetsList->other_days }}' id='other_days' type='text' maxlength="50" class="form-control" title='Прочие дни разрешеные законом (оплачиваемые)'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='unpaid_leave'>Не оплачиваемый отпуск с разрешения администрации</label>
                                    <input name='unpaid_leave' value='{{ $baseTimesheetsList->unpaid_leave }}' id='unpaid_leave' type='text' maxlength="50" class="form-control" title='Не оплачиваемый отпуск с разрешения администрации'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='absense from work'>Дни прогулов</label>
                                    <input name='absense from work' value='{{ $baseTimesheetsList->absense from work }}' id='absense from work' type='text' maxlength="50" class="form-control" title='Дни прогулов'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='weekend'>Выходные/праздничные дни</label>
                                    <input name='weekend' value='{{ $baseTimesheetsList->weekend }}' id='weekend' type='text' maxlength="50" class="form-control" title='Выходные/праздничные дни'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holidays'>Отработано праздничных дней</label>
                                    <input name='holidays' value='{{ $baseTimesheetsList->holidays }}' id='holidays' type='text' maxlength="50" class="form-control" title='Отработано праздничных дней'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hours'>Отработано часов</label>
                                    <input name='hours' value='{{ $baseTimesheetsList->hours }}' id='hours' type='text' maxlength="50" class="form-control" title='Отработано часов'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_hours'>Отработано часов в ночное время</label>
                                    <input name='night_hours' value='{{ $baseTimesheetsList->night_hours }}' id='night_hours' type='text' maxlength="50" class="form-control" title='Отработано часов в ночное время'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='overtime'>Отработано сверхурочно</label>
                                    <input name='overtime' value='{{ $baseTimesheetsList->overtime }}' id='overtime' type='text' maxlength="50" class="form-control" title='Отработано сверхурочно'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.base-timesheets.show', $baseTimesheetsList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.base-timesheets.show', $baseTimesheetsList->id) }}">{{ __('Отмена') }}</a>
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