@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\HoursBalances $menu, $title, $hoursBalancesList
         * @var \Illuminate\Database\Eloquent $yearsList, $monthsList, $hoursBalanceClassifiersList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('acc.hours-balances.update', $hoursBalancesList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('acc.hours-balances.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='year_id'>Год</label>
                                    <div class="input-group mb-3"
>                                        <select name='year_id' value='{{ $hoursBalancesList->years_id }}' id='year_id' type='text' placeholder="Год" class="form-control" title='Год' required>
                                            @foreach($yearsList as $yearsOption)
                                            <option value="{{ $yearsOption->id }}" 
                                                @if($yearsOption->id == $hoursBalancesList->year_id) selected @endif>
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
>                                        <select name='month_id' value='{{ $hoursBalancesList->months_id }}' id='month_id' type='text' placeholder="Месяц" class="form-control" title='Месяц' required>
                                            @foreach($monthsList as $monthsOption)
                                            <option value="{{ $monthsOption->id }}" 
                                                @if($monthsOption->id == $hoursBalancesList->month_id) selected @endif>
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
                                    <label for='hours_balance_classifier_id'>График распределения часов</label>
                                    <div class="input-group mb-3"
>                                        <select name='hours_balance_classifier_id' value='{{ $hoursBalancesList->hours_balance_classifiers_id }}' id='hours_balance_classifier_id' type='text' placeholder="График распределения часов" class="form-control" title='График распределения часов' required>
                                            @foreach($hoursBalanceClassifiersList as $hoursBalanceClassifiersOption)
                                            <option value="{{ $hours_balance_classifiersOption->id }}" 
                                                @if($hoursBalanceClassifiersOption->id == $hoursBalancesList->hours_balance_classifier_id) selected @endif>
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
                                    <label for='balance_days'>Баланс дней</label>
                                    <input name='balance_days' value='{{ $hoursBalancesList->balance_days }}' id='balance_days' type='text' maxlength="50" class="form-control" title='Баланс дней'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='balance_hours'>Баланс часов</label>
                                    <input name='balance_hours' value='{{ $hoursBalancesList->balance_hours }}' id='balance_hours' type='text' maxlength="50" class="form-control" title='Баланс часов'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_1'>1</label>
                                    <input name='day_1' value='{{ $hoursBalancesList->day_1 }}' id='day_1' type='text' maxlength="50" class="form-control" title='1'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_2'>2</label>
                                    <input name='day_2' value='{{ $hoursBalancesList->day_2 }}' id='day_2' type='text' maxlength="50" class="form-control" title='2'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_3'>3</label>
                                    <input name='day_3' value='{{ $hoursBalancesList->day_3 }}' id='day_3' type='text' maxlength="50" class="form-control" title='3'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_4'>4</label>
                                    <input name='day_4' value='{{ $hoursBalancesList->day_4 }}' id='day_4' type='text' maxlength="50" class="form-control" title='4'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_5'>5</label>
                                    <input name='day_5' value='{{ $hoursBalancesList->day_5 }}' id='day_5' type='text' maxlength="50" class="form-control" title='5'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_6'>6</label>
                                    <input name='day_6' value='{{ $hoursBalancesList->day_6 }}' id='day_6' type='text' maxlength="50" class="form-control" title='6'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_7'>7</label>
                                    <input name='day_7' value='{{ $hoursBalancesList->day_7 }}' id='day_7' type='text' maxlength="50" class="form-control" title='7'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_8'>8</label>
                                    <input name='day_8' value='{{ $hoursBalancesList->day_8 }}' id='day_8' type='text' maxlength="50" class="form-control" title='8'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_9'>9</label>
                                    <input name='day_9' value='{{ $hoursBalancesList->day_9 }}' id='day_9' type='text' maxlength="50" class="form-control" title='9'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_10'>10</label>
                                    <input name='day_10' value='{{ $hoursBalancesList->day_10 }}' id='day_10' type='text' maxlength="50" class="form-control" title='10'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_11'>11</label>
                                    <input name='day_11' value='{{ $hoursBalancesList->day_11 }}' id='day_11' type='text' maxlength="50" class="form-control" title='11'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_12'>12</label>
                                    <input name='day_12' value='{{ $hoursBalancesList->day_12 }}' id='day_12' type='text' maxlength="50" class="form-control" title='12'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_13'>13</label>
                                    <input name='day_13' value='{{ $hoursBalancesList->day_13 }}' id='day_13' type='text' maxlength="50" class="form-control" title='13'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_14'>14</label>
                                    <input name='day_14' value='{{ $hoursBalancesList->day_14 }}' id='day_14' type='text' maxlength="50" class="form-control" title='14'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_15'>15</label>
                                    <input name='day_15' value='{{ $hoursBalancesList->day_15 }}' id='day_15' type='text' maxlength="50" class="form-control" title='15'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_16'>16</label>
                                    <input name='day_16' value='{{ $hoursBalancesList->day_16 }}' id='day_16' type='text' maxlength="50" class="form-control" title='16'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_17'>17</label>
                                    <input name='day_17' value='{{ $hoursBalancesList->day_17 }}' id='day_17' type='text' maxlength="50" class="form-control" title='17'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_18'>18</label>
                                    <input name='day_18' value='{{ $hoursBalancesList->day_18 }}' id='day_18' type='text' maxlength="50" class="form-control" title='18'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_19'>19</label>
                                    <input name='day_19' value='{{ $hoursBalancesList->day_19 }}' id='day_19' type='text' maxlength="50" class="form-control" title='19'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_20'>20</label>
                                    <input name='day_20' value='{{ $hoursBalancesList->day_20 }}' id='day_20' type='text' maxlength="50" class="form-control" title='20'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_21'>21</label>
                                    <input name='day_21' value='{{ $hoursBalancesList->day_21 }}' id='day_21' type='text' maxlength="50" class="form-control" title='21'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_22'>22</label>
                                    <input name='day_22' value='{{ $hoursBalancesList->day_22 }}' id='day_22' type='text' maxlength="50" class="form-control" title='22'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_23'>23</label>
                                    <input name='day_23' value='{{ $hoursBalancesList->day_23 }}' id='day_23' type='text' maxlength="50" class="form-control" title='23'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_24'>24</label>
                                    <input name='day_24' value='{{ $hoursBalancesList->day_24 }}' id='day_24' type='text' maxlength="50" class="form-control" title='24'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_25'>25</label>
                                    <input name='day_25' value='{{ $hoursBalancesList->day_25 }}' id='day_25' type='text' maxlength="50" class="form-control" title='25'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_26'>26</label>
                                    <input name='day_26' value='{{ $hoursBalancesList->day_26 }}' id='day_26' type='text' maxlength="50" class="form-control" title='26'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_27'>27</label>
                                    <input name='day_27' value='{{ $hoursBalancesList->day_27 }}' id='day_27' type='text' maxlength="50" class="form-control" title='27'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_28'>28</label>
                                    <input name='day_28' value='{{ $hoursBalancesList->day_28 }}' id='day_28' type='text' maxlength="50" class="form-control" title='28'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_29'>29</label>
                                    <input name='day_29' value='{{ $hoursBalancesList->day_29 }}' id='day_29' type='text' maxlength="50" class="form-control" title='29'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_30'>30</label>
                                    <input name='day_30' value='{{ $hoursBalancesList->day_30 }}' id='day_30' type='text' maxlength="50" class="form-control" title='30'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_31'>31</label>
                                    <input name='day_31' value='{{ $hoursBalancesList->day_31 }}' id='day_31' type='text' maxlength="50" class="form-control" title='31'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_1'>1</label>
                                    <input name='evening_1' value='{{ $hoursBalancesList->evening_1 }}' id='evening_1' type='text' maxlength="50" class="form-control" title='1'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_2'>2</label>
                                    <input name='evening_2' value='{{ $hoursBalancesList->evening_2 }}' id='evening_2' type='text' maxlength="50" class="form-control" title='2'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_3'>3</label>
                                    <input name='evening_3' value='{{ $hoursBalancesList->evening_3 }}' id='evening_3' type='text' maxlength="50" class="form-control" title='3'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_4'>4</label>
                                    <input name='evening_4' value='{{ $hoursBalancesList->evening_4 }}' id='evening_4' type='text' maxlength="50" class="form-control" title='4'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_5'>5</label>
                                    <input name='evening_5' value='{{ $hoursBalancesList->evening_5 }}' id='evening_5' type='text' maxlength="50" class="form-control" title='5'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_6'>6</label>
                                    <input name='evening_6' value='{{ $hoursBalancesList->evening_6 }}' id='evening_6' type='text' maxlength="50" class="form-control" title='6'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_7'>7</label>
                                    <input name='evening_7' value='{{ $hoursBalancesList->evening_7 }}' id='evening_7' type='text' maxlength="50" class="form-control" title='7'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_8'>8</label>
                                    <input name='evening_8' value='{{ $hoursBalancesList->evening_8 }}' id='evening_8' type='text' maxlength="50" class="form-control" title='8'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_9'>9</label>
                                    <input name='evening_9' value='{{ $hoursBalancesList->evening_9 }}' id='evening_9' type='text' maxlength="50" class="form-control" title='9'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_10'>10</label>
                                    <input name='evening_10' value='{{ $hoursBalancesList->evening_10 }}' id='evening_10' type='text' maxlength="50" class="form-control" title='10'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_11'>11</label>
                                    <input name='evening_11' value='{{ $hoursBalancesList->evening_11 }}' id='evening_11' type='text' maxlength="50" class="form-control" title='11'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_12'>12</label>
                                    <input name='evening_12' value='{{ $hoursBalancesList->evening_12 }}' id='evening_12' type='text' maxlength="50" class="form-control" title='12'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_13'>13</label>
                                    <input name='evening_13' value='{{ $hoursBalancesList->evening_13 }}' id='evening_13' type='text' maxlength="50" class="form-control" title='13'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_14'>14</label>
                                    <input name='evening_14' value='{{ $hoursBalancesList->evening_14 }}' id='evening_14' type='text' maxlength="50" class="form-control" title='14'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_15'>15</label>
                                    <input name='evening_15' value='{{ $hoursBalancesList->evening_15 }}' id='evening_15' type='text' maxlength="50" class="form-control" title='15'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_16'>16</label>
                                    <input name='evening_16' value='{{ $hoursBalancesList->evening_16 }}' id='evening_16' type='text' maxlength="50" class="form-control" title='16'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_17'>17</label>
                                    <input name='evening_17' value='{{ $hoursBalancesList->evening_17 }}' id='evening_17' type='text' maxlength="50" class="form-control" title='17'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_18'>18</label>
                                    <input name='evening_18' value='{{ $hoursBalancesList->evening_18 }}' id='evening_18' type='text' maxlength="50" class="form-control" title='18'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_19'>19</label>
                                    <input name='evening_19' value='{{ $hoursBalancesList->evening_19 }}' id='evening_19' type='text' maxlength="50" class="form-control" title='19'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_20'>20</label>
                                    <input name='evening_20' value='{{ $hoursBalancesList->evening_20 }}' id='evening_20' type='text' maxlength="50" class="form-control" title='20'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_21'>21</label>
                                    <input name='evening_21' value='{{ $hoursBalancesList->evening_21 }}' id='evening_21' type='text' maxlength="50" class="form-control" title='21'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_22'>22</label>
                                    <input name='evening_22' value='{{ $hoursBalancesList->evening_22 }}' id='evening_22' type='text' maxlength="50" class="form-control" title='22'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_23'>23</label>
                                    <input name='evening_23' value='{{ $hoursBalancesList->evening_23 }}' id='evening_23' type='text' maxlength="50" class="form-control" title='23'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_24'>24</label>
                                    <input name='evening_24' value='{{ $hoursBalancesList->evening_24 }}' id='evening_24' type='text' maxlength="50" class="form-control" title='24'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_25'>25</label>
                                    <input name='evening_25' value='{{ $hoursBalancesList->evening_25 }}' id='evening_25' type='text' maxlength="50" class="form-control" title='25'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_26'>26</label>
                                    <input name='evening_26' value='{{ $hoursBalancesList->evening_26 }}' id='evening_26' type='text' maxlength="50" class="form-control" title='26'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_27'>27</label>
                                    <input name='evening_27' value='{{ $hoursBalancesList->evening_27 }}' id='evening_27' type='text' maxlength="50" class="form-control" title='27'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_28'>28</label>
                                    <input name='evening_28' value='{{ $hoursBalancesList->evening_28 }}' id='evening_28' type='text' maxlength="50" class="form-control" title='28'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_29'>29</label>
                                    <input name='evening_29' value='{{ $hoursBalancesList->evening_29 }}' id='evening_29' type='text' maxlength="50" class="form-control" title='29'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_30'>30</label>
                                    <input name='evening_30' value='{{ $hoursBalancesList->evening_30 }}' id='evening_30' type='text' maxlength="50" class="form-control" title='30'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='evening_31'>31</label>
                                    <input name='evening_31' value='{{ $hoursBalancesList->evening_31 }}' id='evening_31' type='text' maxlength="50" class="form-control" title='31'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_1'>1</label>
                                    <input name='night_1' value='{{ $hoursBalancesList->night_1 }}' id='night_1' type='text' maxlength="50" class="form-control" title='1'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_2'>2</label>
                                    <input name='night_2' value='{{ $hoursBalancesList->night_2 }}' id='night_2' type='text' maxlength="50" class="form-control" title='2'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_3'>3</label>
                                    <input name='night_3' value='{{ $hoursBalancesList->night_3 }}' id='night_3' type='text' maxlength="50" class="form-control" title='3'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_4'>4</label>
                                    <input name='night_4' value='{{ $hoursBalancesList->night_4 }}' id='night_4' type='text' maxlength="50" class="form-control" title='4'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_5'>5</label>
                                    <input name='night_5' value='{{ $hoursBalancesList->night_5 }}' id='night_5' type='text' maxlength="50" class="form-control" title='5'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_6'>6</label>
                                    <input name='night_6' value='{{ $hoursBalancesList->night_6 }}' id='night_6' type='text' maxlength="50" class="form-control" title='6'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_7'>7</label>
                                    <input name='night_7' value='{{ $hoursBalancesList->night_7 }}' id='night_7' type='text' maxlength="50" class="form-control" title='7'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_8'>8</label>
                                    <input name='night_8' value='{{ $hoursBalancesList->night_8 }}' id='night_8' type='text' maxlength="50" class="form-control" title='8'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_9'>9</label>
                                    <input name='night_9' value='{{ $hoursBalancesList->night_9 }}' id='night_9' type='text' maxlength="50" class="form-control" title='9'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_10'>10</label>
                                    <input name='night_10' value='{{ $hoursBalancesList->night_10 }}' id='night_10' type='text' maxlength="50" class="form-control" title='10'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_11'>11</label>
                                    <input name='night_11' value='{{ $hoursBalancesList->night_11 }}' id='night_11' type='text' maxlength="50" class="form-control" title='11'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_12'>12</label>
                                    <input name='night_12' value='{{ $hoursBalancesList->night_12 }}' id='night_12' type='text' maxlength="50" class="form-control" title='12'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_13'>13</label>
                                    <input name='night_13' value='{{ $hoursBalancesList->night_13 }}' id='night_13' type='text' maxlength="50" class="form-control" title='13'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_14'>14</label>
                                    <input name='night_14' value='{{ $hoursBalancesList->night_14 }}' id='night_14' type='text' maxlength="50" class="form-control" title='14'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_15'>15</label>
                                    <input name='night_15' value='{{ $hoursBalancesList->night_15 }}' id='night_15' type='text' maxlength="50" class="form-control" title='15'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_16'>16</label>
                                    <input name='night_16' value='{{ $hoursBalancesList->night_16 }}' id='night_16' type='text' maxlength="50" class="form-control" title='16'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_17'>17</label>
                                    <input name='night_17' value='{{ $hoursBalancesList->night_17 }}' id='night_17' type='text' maxlength="50" class="form-control" title='17'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_18'>18</label>
                                    <input name='night_18' value='{{ $hoursBalancesList->night_18 }}' id='night_18' type='text' maxlength="50" class="form-control" title='18'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_19'>19</label>
                                    <input name='night_19' value='{{ $hoursBalancesList->night_19 }}' id='night_19' type='text' maxlength="50" class="form-control" title='19'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_20'>20</label>
                                    <input name='night_20' value='{{ $hoursBalancesList->night_20 }}' id='night_20' type='text' maxlength="50" class="form-control" title='20'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_21'>21</label>
                                    <input name='night_21' value='{{ $hoursBalancesList->night_21 }}' id='night_21' type='text' maxlength="50" class="form-control" title='21'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_22'>22</label>
                                    <input name='night_22' value='{{ $hoursBalancesList->night_22 }}' id='night_22' type='text' maxlength="50" class="form-control" title='22'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_23'>23</label>
                                    <input name='night_23' value='{{ $hoursBalancesList->night_23 }}' id='night_23' type='text' maxlength="50" class="form-control" title='23'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_24'>24</label>
                                    <input name='night_24' value='{{ $hoursBalancesList->night_24 }}' id='night_24' type='text' maxlength="50" class="form-control" title='24'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_25'>25</label>
                                    <input name='night_25' value='{{ $hoursBalancesList->night_25 }}' id='night_25' type='text' maxlength="50" class="form-control" title='25'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_26'>26</label>
                                    <input name='night_26' value='{{ $hoursBalancesList->night_26 }}' id='night_26' type='text' maxlength="50" class="form-control" title='26'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_27'>27</label>
                                    <input name='night_27' value='{{ $hoursBalancesList->night_27 }}' id='night_27' type='text' maxlength="50" class="form-control" title='27'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_28'>28</label>
                                    <input name='night_28' value='{{ $hoursBalancesList->night_28 }}' id='night_28' type='text' maxlength="50" class="form-control" title='28'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_29'>29</label>
                                    <input name='night_29' value='{{ $hoursBalancesList->night_29 }}' id='night_29' type='text' maxlength="50" class="form-control" title='29'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_30'>30</label>
                                    <input name='night_30' value='{{ $hoursBalancesList->night_30 }}' id='night_30' type='text' maxlength="50" class="form-control" title='30'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='night_31'>31</label>
                                    <input name='night_31' value='{{ $hoursBalancesList->night_31 }}' id='night_31' type='text' maxlength="50" class="form-control" title='31'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_1'>1</label>
                                    <input name='holiday_1' value='{{ $hoursBalancesList->holiday_1 }}' id='holiday_1' type='text' maxlength="50" class="form-control" title='1'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_2'>2</label>
                                    <input name='holiday_2' value='{{ $hoursBalancesList->holiday_2 }}' id='holiday_2' type='text' maxlength="50" class="form-control" title='2'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_3'>3</label>
                                    <input name='holiday_3' value='{{ $hoursBalancesList->holiday_3 }}' id='holiday_3' type='text' maxlength="50" class="form-control" title='3'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_4'>4</label>
                                    <input name='holiday_4' value='{{ $hoursBalancesList->holiday_4 }}' id='holiday_4' type='text' maxlength="50" class="form-control" title='4'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_5'>5</label>
                                    <input name='holiday_5' value='{{ $hoursBalancesList->holiday_5 }}' id='holiday_5' type='text' maxlength="50" class="form-control" title='5'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_6'>6</label>
                                    <input name='holiday_6' value='{{ $hoursBalancesList->holiday_6 }}' id='holiday_6' type='text' maxlength="50" class="form-control" title='6'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_7'>7</label>
                                    <input name='holiday_7' value='{{ $hoursBalancesList->holiday_7 }}' id='holiday_7' type='text' maxlength="50" class="form-control" title='7'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_8'>8</label>
                                    <input name='holiday_8' value='{{ $hoursBalancesList->holiday_8 }}' id='holiday_8' type='text' maxlength="50" class="form-control" title='8'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_9'>9</label>
                                    <input name='holiday_9' value='{{ $hoursBalancesList->holiday_9 }}' id='holiday_9' type='text' maxlength="50" class="form-control" title='9'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_10'>10</label>
                                    <input name='holiday_10' value='{{ $hoursBalancesList->holiday_10 }}' id='holiday_10' type='text' maxlength="50" class="form-control" title='10'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_11'>11</label>
                                    <input name='holiday_11' value='{{ $hoursBalancesList->holiday_11 }}' id='holiday_11' type='text' maxlength="50" class="form-control" title='11'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_12'>12</label>
                                    <input name='holiday_12' value='{{ $hoursBalancesList->holiday_12 }}' id='holiday_12' type='text' maxlength="50" class="form-control" title='12'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_13'>13</label>
                                    <input name='holiday_13' value='{{ $hoursBalancesList->holiday_13 }}' id='holiday_13' type='text' maxlength="50" class="form-control" title='13'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_14'>14</label>
                                    <input name='holiday_14' value='{{ $hoursBalancesList->holiday_14 }}' id='holiday_14' type='text' maxlength="50" class="form-control" title='14'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_15'>15</label>
                                    <input name='holiday_15' value='{{ $hoursBalancesList->holiday_15 }}' id='holiday_15' type='text' maxlength="50" class="form-control" title='15'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_16'>16</label>
                                    <input name='holiday_16' value='{{ $hoursBalancesList->holiday_16 }}' id='holiday_16' type='text' maxlength="50" class="form-control" title='16'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_17'>17</label>
                                    <input name='holiday_17' value='{{ $hoursBalancesList->holiday_17 }}' id='holiday_17' type='text' maxlength="50" class="form-control" title='17'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_18'>18</label>
                                    <input name='holiday_18' value='{{ $hoursBalancesList->holiday_18 }}' id='holiday_18' type='text' maxlength="50" class="form-control" title='18'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_19'>19</label>
                                    <input name='holiday_19' value='{{ $hoursBalancesList->holiday_19 }}' id='holiday_19' type='text' maxlength="50" class="form-control" title='19'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_20'>20</label>
                                    <input name='holiday_20' value='{{ $hoursBalancesList->holiday_20 }}' id='holiday_20' type='text' maxlength="50" class="form-control" title='20'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_21'>21</label>
                                    <input name='holiday_21' value='{{ $hoursBalancesList->holiday_21 }}' id='holiday_21' type='text' maxlength="50" class="form-control" title='21'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_22'>22</label>
                                    <input name='holiday_22' value='{{ $hoursBalancesList->holiday_22 }}' id='holiday_22' type='text' maxlength="50" class="form-control" title='22'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_23'>23</label>
                                    <input name='holiday_23' value='{{ $hoursBalancesList->holiday_23 }}' id='holiday_23' type='text' maxlength="50" class="form-control" title='23'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_24'>24</label>
                                    <input name='holiday_24' value='{{ $hoursBalancesList->holiday_24 }}' id='holiday_24' type='text' maxlength="50" class="form-control" title='24'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_25'>25</label>
                                    <input name='holiday_25' value='{{ $hoursBalancesList->holiday_25 }}' id='holiday_25' type='text' maxlength="50" class="form-control" title='25'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_26'>26</label>
                                    <input name='holiday_26' value='{{ $hoursBalancesList->holiday_26 }}' id='holiday_26' type='text' maxlength="50" class="form-control" title='26'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_27'>27</label>
                                    <input name='holiday_27' value='{{ $hoursBalancesList->holiday_27 }}' id='holiday_27' type='text' maxlength="50" class="form-control" title='27'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_28'>28</label>
                                    <input name='holiday_28' value='{{ $hoursBalancesList->holiday_28 }}' id='holiday_28' type='text' maxlength="50" class="form-control" title='28'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_29'>29</label>
                                    <input name='holiday_29' value='{{ $hoursBalancesList->holiday_29 }}' id='holiday_29' type='text' maxlength="50" class="form-control" title='29'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_30'>30</label>
                                    <input name='holiday_30' value='{{ $hoursBalancesList->holiday_30 }}' id='holiday_30' type='text' maxlength="50" class="form-control" title='30'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday_31'>31</label>
                                    <input name='holiday_31' value='{{ $hoursBalancesList->holiday_31 }}' id='holiday_31' type='text' maxlength="50" class="form-control" title='31'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='weekends'>Баланс выходных дней</label>
                                    <input name='weekends' value='{{ $hoursBalancesList->weekends }}' id='weekends' type='text' maxlength="50" class="form-control" title='Баланс выходных дней'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holidays'>Баланс праздничных дней</label>
                                    <input name='holidays' value='{{ $hoursBalancesList->holidays }}' id='holidays' type='text' maxlength="50" class="form-control" title='Баланс праздничных дней'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='balance_evening'>Баланс вечерних часов</label>
                                    <input name='balance_evening' value='{{ $hoursBalancesList->balance_evening }}' id='balance_evening' type='text' maxlength="50" class="form-control" title='Баланс вечерних часов'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='balance_night'>Баланс ночных часов</label>
                                    <input name='balance_night' value='{{ $hoursBalancesList->balance_night }}' id='balance_night' type='text' maxlength="50" class="form-control" title='Баланс ночных часов'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.hours-balances.show', $hoursBalancesList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.hours-balances.show', $hoursBalancesList->id) }}">{{ __('Отмена') }}</a>
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