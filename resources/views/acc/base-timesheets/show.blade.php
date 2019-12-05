@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\BaseTimesheets $menu, $title, $baseTimesheetsList */
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
                                    <input name='personal_card' value='{{ $baseTimesheetsList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='year'>Год</label>
                                    <input name='year' value='{{ $baseTimesheetsList->year }}' id='year' type='text' maxlength="50" readonly class="form-control" title='Год'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='month'>Месяц</label>
                                    <input name='month' value='{{ $baseTimesheetsList->month }}' id='month' type='text' maxlength="50" readonly class="form-control" title='Месяц'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_1'>1</label>
                                    <input name='day_1' value='{{ $baseTimesheetsList->day_1 }}' id='day_1' type='text' maxlength="50" readonly class="form-control" title='1'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_2'>2</label>
                                    <input name='day_2' value='{{ $baseTimesheetsList->day_2 }}' id='day_2' type='text' maxlength="50" readonly class="form-control" title='2'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_3'>3</label>
                                    <input name='day_3' value='{{ $baseTimesheetsList->day_3 }}' id='day_3' type='text' maxlength="50" readonly class="form-control" title='3'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_4'>4</label>
                                    <input name='day_4' value='{{ $baseTimesheetsList->day_4 }}' id='day_4' type='text' maxlength="50" readonly class="form-control" title='4'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_5'>5</label>
                                    <input name='day_5' value='{{ $baseTimesheetsList->day_5 }}' id='day_5' type='text' maxlength="50" readonly class="form-control" title='5'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_6'>6</label>
                                    <input name='day_6' value='{{ $baseTimesheetsList->day_6 }}' id='day_6' type='text' maxlength="50" readonly class="form-control" title='6'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_7'>7</label>
                                    <input name='day_7' value='{{ $baseTimesheetsList->day_7 }}' id='day_7' type='text' maxlength="50" readonly class="form-control" title='7'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_8'>8</label>
                                    <input name='day_8' value='{{ $baseTimesheetsList->day_8 }}' id='day_8' type='text' maxlength="50" readonly class="form-control" title='8'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_9'>9</label>
                                    <input name='day_9' value='{{ $baseTimesheetsList->day_9 }}' id='day_9' type='text' maxlength="50" readonly class="form-control" title='9'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_10'>10</label>
                                    <input name='day_10' value='{{ $baseTimesheetsList->day_10 }}' id='day_10' type='text' maxlength="50" readonly class="form-control" title='10'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_11'>11</label>
                                    <input name='day_11' value='{{ $baseTimesheetsList->day_11 }}' id='day_11' type='text' maxlength="50" readonly class="form-control" title='11'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_12'>12</label>
                                    <input name='day_12' value='{{ $baseTimesheetsList->day_12 }}' id='day_12' type='text' maxlength="50" readonly class="form-control" title='12'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_13'>13</label>
                                    <input name='day_13' value='{{ $baseTimesheetsList->day_13 }}' id='day_13' type='text' maxlength="50" readonly class="form-control" title='13'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_14'>14</label>
                                    <input name='day_14' value='{{ $baseTimesheetsList->day_14 }}' id='day_14' type='text' maxlength="50" readonly class="form-control" title='14'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_15'>15</label>
                                    <input name='day_15' value='{{ $baseTimesheetsList->day_15 }}' id='day_15' type='text' maxlength="50" readonly class="form-control" title='15'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_16'>16</label>
                                    <input name='day_16' value='{{ $baseTimesheetsList->day_16 }}' id='day_16' type='text' maxlength="50" readonly class="form-control" title='16'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_17'>17</label>
                                    <input name='day_17' value='{{ $baseTimesheetsList->day_17 }}' id='day_17' type='text' maxlength="50" readonly class="form-control" title='17'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_18'>18</label>
                                    <input name='day_18' value='{{ $baseTimesheetsList->day_18 }}' id='day_18' type='text' maxlength="50" readonly class="form-control" title='18'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_19'>19</label>
                                    <input name='day_19' value='{{ $baseTimesheetsList->day_19 }}' id='day_19' type='text' maxlength="50" readonly class="form-control" title='19'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_20'>20</label>
                                    <input name='day_20' value='{{ $baseTimesheetsList->day_20 }}' id='day_20' type='text' maxlength="50" readonly class="form-control" title='20'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_21'>21</label>
                                    <input name='day_21' value='{{ $baseTimesheetsList->day_21 }}' id='day_21' type='text' maxlength="50" readonly class="form-control" title='21'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_22'>22</label>
                                    <input name='day_22' value='{{ $baseTimesheetsList->day_22 }}' id='day_22' type='text' maxlength="50" readonly class="form-control" title='22'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_23'>23</label>
                                    <input name='day_23' value='{{ $baseTimesheetsList->day_23 }}' id='day_23' type='text' maxlength="50" readonly class="form-control" title='23'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_24'>24</label>
                                    <input name='day_24' value='{{ $baseTimesheetsList->day_24 }}' id='day_24' type='text' maxlength="50" readonly class="form-control" title='24'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_25'>25</label>
                                    <input name='day_25' value='{{ $baseTimesheetsList->day_25 }}' id='day_25' type='text' maxlength="50" readonly class="form-control" title='25'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_26'>26</label>
                                    <input name='day_26' value='{{ $baseTimesheetsList->day_26 }}' id='day_26' type='text' maxlength="50" readonly class="form-control" title='26'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_27'>27</label>
                                    <input name='day_27' value='{{ $baseTimesheetsList->day_27 }}' id='day_27' type='text' maxlength="50" readonly class="form-control" title='27'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_28'>28</label>
                                    <input name='day_28' value='{{ $baseTimesheetsList->day_28 }}' id='day_28' type='text' maxlength="50" readonly class="form-control" title='28'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_29'>29</label>
                                    <input name='day_29' value='{{ $baseTimesheetsList->day_29 }}' id='day_29' type='text' maxlength="50" readonly class="form-control" title='29'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_30'>30</label>
                                    <input name='day_30' value='{{ $baseTimesheetsList->day_30 }}' id='day_30' type='text' maxlength="50" readonly class="form-control" title='30'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='day_31'>31</label>
                                    <input name='day_31' value='{{ $baseTimesheetsList->day_31 }}' id='day_31' type='text' maxlength="50" readonly class="form-control" title='31'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hours'>Отработано часов</label>
                                    <input name='hours' value='{{ $baseTimesheetsList->hours }}' id='hours' type='text' maxlength="50" readonly class="form-control" title='Отработано часов'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='rate'>Ставка</label>
                                    <input name='rate' value='{{ $baseTimesheetsList->rate }}' id='rate' type='text' maxlength="50" readonly class="form-control" title='Ставка'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hourly'>Почасово</label>
                                    <input name='hourly' value='{{ $baseTimesheetsList->hourly }}' id='hourly' type='text' maxlength="50" readonly class="form-control" title='Почасово'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='piecework'>Сдельно</label>
                                    <input name='piecework' value='{{ $baseTimesheetsList->piecework }}' id='piecework' type='text' maxlength="50" readonly class="form-control" title='Сдельно'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='return_fix'>Возврат поправки</label>
                                    <input name='return_fix' value='{{ $baseTimesheetsList->return_fix }}' id='return_fix' type='text' maxlength="50" readonly class="form-control" title='Возврат поправки'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='retention_fix'>Удержано поправки</label>
                                    <input name='retention_fix' value='{{ $baseTimesheetsList->retention_fix }}' id='retention_fix' type='text' maxlength="50" readonly class="form-control" title='Удержано поправки'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='penalty'>Штраф</label>
                                    <input name='penalty' value='{{ $baseTimesheetsList->penalty }}' id='penalty' type='text' maxlength="50" readonly class="form-control" title='Штраф'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='prepaid_expense'>Аванс</label>
                                    <input name='prepaid_expense' value='{{ $baseTimesheetsList->prepaid_expense }}' id='prepaid_expense' type='text' maxlength="50" readonly class="form-control" title='Аванс'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='food'>Питание</label>
                                    <input name='food' value='{{ $baseTimesheetsList->food }}' id='food' type='text' maxlength="50" readonly class="form-control" title='Питание'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='work_clothes'>Спецодежда</label>
                                    <input name='work_clothes' value='{{ $baseTimesheetsList->work_clothes }}' id='work_clothes' type='text' maxlength="50" readonly class="form-control" title='Спецодежда'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='total'>Итоговая сумма</label>
                                    <input name='total' value='{{ $baseTimesheetsList->total }}' id='total' type='text' maxlength="50" readonly class="form-control" title='Итоговая сумма'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='object'>Объект выполнения работ</label>
                                    <input name='object' value='{{ $baseTimesheetsList->object }}' id='object' type='text' maxlength="50" readonly class="form-control" title='Объект выполнения работ'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        @if ($access == 2)
                        <form name="delete" method="POST" action="{{ route('acc.base-timesheets.destroy', $baseTimesheetsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.base-timesheets.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.base-timesheets.edit', $baseTimesheetsList->id) }}">{{ __('Изменить') }}</a>
                                    <button type="submit" class="btn btn-outline-danger" href="#">{{ __('Удалить') }}</button>
                                </div>
                            </div>
                        </form>
						@endif
                        @if ($access == 1)
                        <div class="row justify-content-center">
                            <div class='form-group col-md-10'>
								<a class="btn btn-outline-secondary" href="{{ route('acc.base-timesheets.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                        </div>
						@endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection