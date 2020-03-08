@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\BaseTimesheets $menu, $title, $team, $year, $month
         * @var \Illuminate\Database\Eloquent $base-timesheetsList, $personalCardsList, $yearsList, $monthsList, $objectsList
         */
        $team_id = 0;
    @endphp

    <form method="POST" action="{{ route('acc.base-timesheets.update', $id) }}">
        @method('PATCH')
        @csrf
        <div class="container">
            @php
                /** @var \Illuminate\Support\ViewErrorBag @errors */
            @endphp
            @include('acc.base-timesheets.includes.result_messages')
            <div class="row justify-content">
                <div class="row col-md-12" style="margin-bottom: -10px">
                    <div class="mr-auto">
                        <h3 id="header">{{ $title }}: <small>{{ $month->title }} {{ $year->number }}</small></h3>
                        <input name='team_id' id='team_id' value='{{ $team->id }}' type='hidden'>
                        <input name='year' id='year_id' value='{{ $year->number }}' type='hidden'>
                        <input name='year_id' id='year_id' value='{{ $year->id }}' type='hidden'>
                        <input name='month' id='month_id' value='{{ $month->number }}' type='hidden'>
                        <input name='month_id' id='month_id' value='{{ $month->id }}' type='hidden'>
                    </div>
                    <div class="ml-auto">
                        <div class="form-row">
                            <div class='form-group col-md-auto'>
                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.base-timesheets.index') }}"><img src="/img/visibility_off_black_18dp.png" alt="Закрыть" title="Закрыть"></a>
                                <button type="submit" class="btn btn-outline-success btn-sm">
                                    <img src="/img/save_black_18dp.png" alt="Сохранить" title="Сохранить">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="width: 220%">
            <div class="row justify-content" style="width: 220%">
                <div class="row justify-content-center">
                    <div class='form-row col-md-12'>
                        <div class='form-row'>
                            <div>
                                <input name='personal_card' id='personal_card_id' value='Сотрудник'  disabled class="form-control form-control-sm" style="width: 340px;" type='text' title='Работник'>
                            </div>
                            <div>
                                <input name='object' id='object_id' value='Объект' type='text'  disabled class="form-control form-control-sm" style="width: 60px;" title='B-86 Polbet Warszawa'>
                            </div>
                        </div>
                        <div style="margin-left: 10px;">
                            <div class='form-row'>
                                <div>
                                    <input name='auto' id='auto' value="Автомат" type='text' readonly class="form-control form-control-sm auto-base-timesheets" style="width: 70px; cursor: pointer;" title='Автозаполнение'>
                                </div>
                                @for ($i = 1; $i < 32; $i++)
                                <div>
                                    @if($i == 1)
                                    <input name='hours_day_1' id='hours_day_1' value='1   ◄' type='text' readonly class="form-control form-control-sm" style="width: 50px; cursor: pointer;" title='{{ $i }}-й день месяца'>
                                    @elseif($i == 11)
                                    <input name='hours_day_11' id='hours_day_11' value='11 ◄' type='text' readonly class="form-control form-control-sm" style="width: 50px; cursor: pointer;" title='{{ $i }}-й день месяца'>
                                    @elseif($i == 21)
                                    <input name='hours_day_21' id='hours_day_21' value='21 ◄' type='text' readonly class="form-control form-control-sm" style="width: 50px; cursor: pointer;" title='{{ $i }}-й день месяца'>
                                    @else
                                    <input name='hours_day_{{ $i }}' id='hours_day_{{ $i }}' value='{{ $i }}' type='text' disabled class="form-control form-control-sm" style="width: 50px;" title='{{ $i }}-й день месяца'>
                                    @endif
                                </div>
                                @endfor
                                <div>
                                    <input name='hours' id='hours' value=' ' type='text'  disabled class="form-control form-control-sm" style="width: 60px;" title='Отработано по средневзвешенной ставке'>
                                </div>
                            </div>
                        </div>
                        <div class='form-row' style="margin-left: 5px;">
                            <div>
                                <input name='hourly' id='hourly' value='Почасово' type='text'  disabled class="form-control form-control-sm" style="width: 80px;" title='Почасово'>
                            </div>
                            <div>
                                <input name='piecework' id='piecework' value='Сдельно' type='text'  disabled class="form-control form-control-sm" style="width: 80px;" title='Сдельно'>
                            </div>
                            <div>
                                <input name='total' id='total' value='Итого' type='text'  disabled class="form-control form-control-sm" style="width: 80px;" title='Итоговая сумма'>
                            </div>
                        </div>
                    </div>
                    @if(count($baseTimesheetsList) > 0)
                    @php 
                        $order = 0; 
                    @endphp
                    @foreach($baseTimesheetsList as $baseTimesheetRow)
                    @if($team_id != $baseTimesheetRow->team_id)
                    <div class='form-row col-md-12' style="margin-top: 5px">
                        <div class='form-row'>
                            <div>
                                <input name='department_team_{{ $order }}' id='department_team_{{ $order }}' value='{{ $baseTimesheetRow->department_title }} - {{ $baseTimesheetRow->team_title }}' disabled class="form-control form-control-sm department-team" style="width: 2320px; font-style: italic; font-weight: bold;" type='text' title='Подразделение - бригада'>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class='form-row col-md-12' style="margin-top: 5px">
                        <div class='form-row'>
                            <div>
                                <input name='personal_card_{{ $order }}' id='personal_card_{{ $order }}' value='{{ $baseTimesheetRow->surname }} {{ $baseTimesheetRow->first_name }} {{ $baseTimesheetRow->second_name }}'  disabled class="form-control form-control-sm" style="width: 240px; height: 58px;" type='text' title='Работник'>
                                <input name='personal_card_id_{{ $order }}' id='personal_card_id_{{ $order }}' value='{{ $baseTimesheetRow->personal_card_id }}' type='hidden'>
                                <input name='id_{{ $order }}' id='id_{{ $order }}' value='{{ $baseTimesheetRow->id }}' type='hidden'>
                            </div>
                            <div>
                                <input name='personal_account_{{ $order }}' id='personal_account_{{ $order }}' value='{{ $baseTimesheetRow->personal_account }}'  disabled class="form-control form-control-sm" style="width: 100px; height: 58px;" type='text' title='Работник'>
                            </div>
                            <div>
                                <input name='object_{{ $order }}' id='object_{{ $order }}' value='{{ $baseTimesheetRow->object_abbr }}' type='text'  disabled class="form-control form-control-sm" style="width: 60px; height: 58px;" title='{{ $baseTimesheetRow->object_title }}'>
                                <input name='object_id_{{ $order }}' id='object_id_{{ $order }}' value='{{ $baseTimesheetRow->object_id }}' type='hidden'>
                            </div>
                        </div>
                        <div style="margin-left: 10px;">
                            <div class='form-row'>
                                <div>
                                    <input name='hours_auto_{{ $order }}' id='hours_auto_{{ $order }}' value="Часы:" type='text' readonly class="form-control form-control-sm auto-base-timesheets" style="width: 70px;; cursor: pointer;" title='Заполнить отработанные часы'>
                                </div>
                                <div>
                                    <input name='hours_day_1_{{ $order }}' id='hours_day_1_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_1 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 1-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_2_{{ $order }}' id='hours_day_2_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_2 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 2-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_3_{{ $order }}' id='hours_day_3_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_3 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 3-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_4_{{ $order }}' id='hours_day_4_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_4 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 4-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_5_{{ $order }}' id='hours_day_5_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_5 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 5-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_6_{{ $order }}' id='hours_day_6_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_6 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 6-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_7_{{ $order }}' id='hours_day_7_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_7 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 7-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_8_{{ $order }}' id='hours_day_8_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_8 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 8-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_9_{{ $order }}' id='hours_day_9_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_9 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 9-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_10_{{ $order }}' id='hours_day_10_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_10 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 10-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_11_{{ $order }}' id='hours_day_11_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_11 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 11-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_12_{{ $order }}' id='hours_day_12_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_12 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 12-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_13_{{ $order }}' id='hours_day_13_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_13 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 13-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_14_{{ $order }}' id='hours_day_14_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_14 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 14-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_15_{{ $order }}' id='hours_day_15_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_15 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 15-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_16_{{ $order }}' id='hours_day_16_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_16 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 16-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_17_{{ $order }}' id='hours_day_17_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_17 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 17-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_18_{{ $order }}' id='hours_day_18_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_18 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 18-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_19_{{ $order }}' id='hours_day_19_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_19 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 19-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_20_{{ $order }}' id='hours_day_20_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_20 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 20-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_21_{{ $order }}' id='hours_day_21_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_21 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 21-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_22_{{ $order }}' id='hours_day_22_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_22 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 22-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_23_{{ $order }}' id='hours_day_23_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_23 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 23-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_24_{{ $order }}' id='hours_day_24_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_24 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 24-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_25_{{ $order }}' id='hours_day_25_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_25 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 25-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_26_{{ $order }}' id='hours_day_26_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_26 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 26-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_27_{{ $order }}' id='hours_day_27_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_27 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 27-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_28_{{ $order }}' id='hours_day_28_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_28 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 28-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_29_{{ $order }}' id='hours_day_29_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_29 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 29-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_30_{{ $order }}' id='hours_day_30_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_30 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 30-го дня'>
                                </div>
                                <div>
                                    <input name='hours_day_31_{{ $order }}' id='hours_day_31_{{ $order }}' value='{{ $baseTimesheetRow->hours_day_31 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы 31-го дня'>
                                </div>
                                <div>
                                    <input name='hours_{{ $order }}' id='hours_{{ $order }}' value='{{ $baseTimesheetRow->hours }}' type='text' readonly class="form-control form-control-sm" style="width: 60px;" title='Отработано часов'>
                                </div>
                            </div>
                            <div class='form-row'>
                                <div>
                                    <input name='rate_auto_{{ $order }}' id='rate_auto_{{ $order }}' value="Ставка:" type='text' readonly class="form-control form-control-sm auto-base-timesheets" style="width: 70px;; cursor: pointer;" title='Заполнить дневные ставки'>
                                </div>
                                <div>
                                    <input name='rate_day_1_{{ $order }}' id='rate_day_1_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_1 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 1-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_2_{{ $order }}' id='rate_day_2_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_2 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 2-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_3_{{ $order }}' id='rate_day_3_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_3 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 3-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_4_{{ $order }}' id='rate_day_4_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_4 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 4-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_5_{{ $order }}' id='rate_day_5_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_5 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 5-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_6_{{ $order }}' id='rate_day_6_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_6 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 6-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_7_{{ $order }}' id='rate_day_7_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_7 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 7-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_8_{{ $order }}' id='rate_day_8_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_8 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 8-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_9_{{ $order }}' id='rate_day_9_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_9 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 9-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_10_{{ $order }}' id='rate_day_10_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_10 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 10-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_11_{{ $order }}' id='rate_day_11_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_11 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 11-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_12_{{ $order }}' id='rate_day_12_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_12 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 12-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_13_{{ $order }}' id='rate_day_13_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_13 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 13-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_14_{{ $order }}' id='rate_day_14_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_14 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 14-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_15_{{ $order }}' id='rate_day_15_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_15 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 15-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_16_{{ $order }}' id='rate_day_16_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_16 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 16-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_17_{{ $order }}' id='rate_day_17_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_17 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 17-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_18_{{ $order }}' id='rate_day_18_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_18 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 18-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_19_{{ $order }}' id='rate_day_19_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_19 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 19-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_20_{{ $order }}' id='rate_day_20_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_20 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 20-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_21_{{ $order }}' id='rate_day_21_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_21 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 21-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_22_{{ $order }}' id='rate_day_22_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_22 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 22-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_23_{{ $order }}' id='rate_day_23_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_23 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 23-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_24_{{ $order }}' id='rate_day_24_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_24 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 24-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_25_{{ $order }}' id='rate_day_25_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_25 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 25-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_26_{{ $order }}' id='rate_day_26_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_26 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 26-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_27_{{ $order }}' id='rate_day_27_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_27 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 27-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_28_{{ $order }}' id='rate_day_28_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_28 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 28-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_29_{{ $order }}' id='rate_day_29_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_29 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 29-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_30_{{ $order }}' id='rate_day_30_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_30 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 30-го дня'>
                                </div>
                                <div>
                                    <input name='rate_day_31_{{ $order }}' id='rate_day_31_{{ $order }}' value='{{ $baseTimesheetRow->rate_day_31 }}' type='text' autocomplete="off" class="form-control form-control-sm calc-base-timesheets" style="width: 50px; background: #ffc;" title='Цена часа 31-го дня'>
                                </div>
                                <div>
                                    <input name='rate_{{ $order }}' id='rate_{{ $order }}' value='{{ $baseTimesheetRow->rate }}' type='text' readonly class="form-control form-control-sm" style="width: 60px;" title='Средневзвешенная ставка'>
                                </div>
                            </div>
                        </div>
                        <div class='form-row' style="margin-left: 5px;">
                            <div>
                                <input name='hourly_{{ $order }}' id='hourly_{{ $order }}' value='{{ $baseTimesheetRow->hourly }}' type='text' readonly class="form-control form-control-sm" style="width: 80px; height: 58px;" title='Почасово'>
                            </div>
                            <div>
                                <input name='piecework_{{ $order }}' id='piecework_{{ $order }}' value='{{ $baseTimesheetRow->piecework }}' type='text' readonly class="form-control form-control-sm" style="width: 80px; height: 58px;" title='Сдельно'>
                            </div>
                            <div>
                                <input name='total_{{ $order }}' id='total_{{ $order }}' value='{{ $baseTimesheetRow->total }}' type='text' readonly class="form-control form-control-sm" style="width: 80px; height: 58px;" title='Итоговая сумма'>
                            </div>
                        </div>
                    </div>
                    @php 
                        $order++; 
                        $team_id = $baseTimesheetRow->team_id;
                    @endphp
                    @endforeach
                    @else	
                    <div class='form-row col-md-12' style="margin-top: 5px">
                        <div class='form-row'>
                            <div>
                                <input name='personal_card_id_0' id='personal_card_id_0' value='Нет данных' disabled class="form-control form-control-sm" style="width: 240px; height: 58px;" type='text' title='Работник'>
                            </div>
                            <div>
                                <input name='personal_account_0' id='personal_account_0' value='---' disabled class="form-control form-control-sm" style="width: 100px; height: 58px;" type='text' title='Работник'>
                            </div>
                            <div>
                                <input name='object_id_0' id='object_id_0' value='---' type='text' disabled class="form-control form-control-sm" style="width: 60px; height: 58px;" title='B-86 Polbet Warszawa'>
                            </div>
                        </div>
                        <div style="margin-left: 10px;">
                            <div class='form-row'>
                                <div>
                                    <input name='hours_auto_0' id='hours_auto_0' value="Часы:" type='text' readonly class="form-control form-control-sm auto-base-timesheets" style="width: 70px; cursor: pointer;" title='Заполнить отработанные часы'>
                                </div>
                                @for ($i = 1; $i < 32; $i++)
                                <div>
                                    <input name='hours_day_{{ $i }}_0' id='hours_day_{{ $i }}_0' type='text' readonly class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Часы {{ $i }}-го дня'>
                                </div>
                                @endfor
                                <div>
                                    <input name='hours_0' id='hours_0' value='0' type='text' readonly class="form-control form-control-sm" style="width: 60px;" title='Отработано часов'>
                                </div>
                            </div>
                            <div class='form-row'>
                                <div>
                                    <input name='rate_auto' id='rate_auto_0' value="Ставка:" type='text' readonly class="form-control form-control-sm auto-base-timesheets" style="width: 70px; cursor: pointer;" title='Заполнить дневные ставки'>
                                </div>
                                @for ($i = 1; $i < 32; $i++)
                                <div>
                                    <input name='rate_day_{{ $i }}_0' id='rate_day_{{ $i }}_0' type='text' readonly class="form-control form-control-sm calc-base-timesheets" style="width: 50px;" title='Цена часа {{ $i }}-го дня'>
                                </div>
                                @endfor
                                <div>
                                    <input name='rate_0' id='rate_0' value='0' type='text' readonly class="form-control form-control-sm" style="width: 60px;" title='Средневзвешенная ставка'>
                                </div>
                            </div>
                        </div>
                        <div class='form-row' style="margin-left: 5px;">
                            <div>
                                <input name='hourly_0' id='hourly_0' value='0' type='text'  disabled class="form-control form-control-sm" style="width: 80px; height: 58px;" title='Почасово'>
                            </div>
                            <div>
                                <input name='piecework_0' id='piecework_0' value='0' type='text'  disabled class="form-control form-control-sm" style="width: 80px; height: 58px;" title='Сдельно'>
                            </div>
                            <div>
                                <input name='total_0' id='total_0' value='0' type='text'  disabled class="form-control form-control-sm" style="width: 80px; height: 58px;" title='Итоговая сумма'>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
    @php
    if(isset($baseTimesheetsList)) { 
        if(count($baseTimesheetsList) > 0) { 
            echo "<script type='text/javascript'>var gOrderCount = ".count($baseTimesheetsList).";</script>";
        } else { 
            echo "<script type='text/javascript'>var gOrderCount = 0;</script>";
        }
    } else { 
        echo "<script type='text/javascript'>var gOrderCount = 0;</script>";
    }
    @endphp
@endsection