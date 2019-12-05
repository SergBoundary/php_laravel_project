@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\BaseTimesheets $menu, $title, $baseTimesheetsList
         * @var \Illuminate\Database\Eloquent $personalCardsList, $yearsList, $monthsList, $objectsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content" style="margin-left: -100px;">
            <h3>{{$title['name']}}</h3>

                <form method="POST" action="{{ route('acc.base-timesheets.store') }}">
                    @csrf
                    @php
                        /** @var \Illuminate\Support\ViewErrorBag @errors */
                    @endphp
                    @include('acc.base-timesheets.includes.result_messages')
                    <div class="row justify-content-center">
						<div class='form-row col-md-12'>
                        <div class='form-row' style="margin-top: 1px;">
                            <div>
                                <input name='personal_card_id' id='personal_card_id' value='Котыло Андрей Иванович' readonly style="width: 200px; height: 47px; font-size: 11px" type='text' title='Работник'>
                            </div>
                            <div>
                                <input name='year_id' id='year_id' value='2019' type='text' readonly style="width: 50px; height: 47px; font-size: 11px" title='Год'>
                            </div>
                            <div>
                                <input name='month_id' id='month_id' value='10' type='text' readonly style="width: 20px; height: 47px; font-size: 11px" title='Месяц'>
                            </div>
                            <div>
                                <input name='object_id' id='object_id' value='B-86 Polbet Warszawa' type='text' readonly style="height: 47px; font-size: 11px" title='Объект'>
                            </div>
						</div>
						<div style="margin-left: 10px;">
						<div class='form-row'>
							@for ($i = 1; $i < 32; $i++)
                                <div>
                                    <input name='hours_day_{{ $i }}' id='hours_day_{{ $i }}' type='text' autocomplete="off" style="width: 20px; font-size: 11px" title='Часы {{ $i }} дня'>
                                </div>
							@endfor
                            <div>
                                <input name='hours' id='hours' value='120' type='text' readonly style="width: 50px; font-size: 11px" title='Отработано часов'>
                            </div>
						</div>
						<div class='form-row'>
							@for ($i = 1; $i < 32; $i++)
                                <div>
                                    <input name='rate_day_{{ $i }}' id='rate_day_{{ $i }}' type='text' autocomplete="off" style="width: 20px; font-size: 11px" title='Ставка {{ $i }} дня'>
                                </div>
							@endfor
                            <div>
                                <input name='rate' id='rate' value='13.5' type='text' readonly style="width: 50px; font-size: 11px" title='Средневзвешенная ставка'>
                            </div>
						</div>
						</div>
                        <div class='form-row' style="margin-top: 1px; margin-left: 5px;">
                            <div>
                                <input name='hourly' id='hourly' value='1620' type='text' readonly style="width: 50px; height: 47px; font-size: 11px" title='Почасово'>
                            </div>
                            <div>
                                <input name='piecework' id='piecework' value='550' type='text' readonly style="width: 50px; height: 47px; font-size: 11px" title='Сдельно'>
                            </div>
                            <div>
                                <input name='total' id='total' value='2170' type='text' readonly style="width: 50px; height: 47px; font-size: 11px" title='Итоговая сумма'>
                            </div>
						</div>
                        </div>
						
						<div class='form-row col-md-12'>
                        <div class='form-row' style="margin-top: 1px;">
                            <div>
                                <input name='personal_card_id' id='personal_card_id' value='Скробот Александр Васильевич' readonly style="width: 200px; height: 47px; font-size: 11px" type='text' title='Работник'>
                            </div>
                            <div>
                                <input name='year_id' id='year_id' value='2019' type='text' readonly style="width: 50px; height: 47px; font-size: 11px" title='Год'>
                            </div>
                            <div>
                                <input name='month_id' id='month_id' value='10' type='text' readonly style="width: 20px; height: 47px; font-size: 11px" title='Месяц'>
                            </div>
                            <div>
                                <input name='object_id' id='object_id' value='B-20 BUDIMEX Gdańsk' type='text' readonly style="height: 47px; font-size: 11px" title='Объект'>
                            </div>
						</div>
						<div style="margin-left: 10px;">
						<div class='form-row'>
							@for ($i = 1; $i < 32; $i++)
                                <div>
                                    <input name='hours_day_{{ $i }}' id='hours_day_{{ $i }}' type='text' autocomplete="off" style="width: 20px; font-size: 11px" title='Часы {{ $i }} дня'>
                                </div>
							@endfor
                            <div>
                                <input name='hours' id='hours' value='120' type='text' readonly style="width: 50px; font-size: 11px" title='Отработано часов'>
                            </div>
						</div>
						<div class='form-row'>
							@for ($i = 1; $i < 32; $i++)
                                <div>
                                    <input name='rate_day_{{ $i }}' id='rate_day_{{ $i }}' type='text' autocomplete="off" style="width: 20px; font-size: 11px" title='Ставка {{ $i }} дня'>
                                </div>
							@endfor
                            <div>
                                <input name='rate' id='rate' value='13.5' type='text' readonly style="width: 50px; font-size: 11px" title='Средневзвешенная ставка'>
                            </div>
						</div>
						</div>
                        <div class='form-row' style="margin-top: 1px; margin-left: 5px;">
                            <div>
                                <input name='hourly' id='hourly' value='1620' type='text' readonly style="width: 50px; height: 47px; font-size: 11px" title='Почасово'>
                            </div>
                            <div>
                                <input name='piecework' id='piecework' value='550' type='text' readonly style="width: 50px; height: 47px; font-size: 11px" title='Сдельно'>
                            </div>
                            <div>
                                <input name='total' id='total' value='2170' type='text' readonly style="width: 50px; height: 47px; font-size: 11px" title='Итоговая сумма'>
                            </div>
						</div>
                        </div>
						
                        <div>
                            <input name='return_fix' id='return_fix' type='text' style="width: 50px; font-size: 11px" title='Возврат поправки'>
                        </div>
                        <div>
                            <input name='retention_fix' id='retention_fix' type='text' style="width: 50px; font-size: 11px" title='Удержано поправки'>
                        </div>
                        <div>
                            <input name='penalty' id='penalty' type='text' style="width: 50px; font-size: 11px" title='Штраф'>
                        </div>
                        <div>
                            <input name='prepaid_expense' id='prepaid_expense' type='text' style="width: 50px; font-size: 11px" title='Аванс'>
                        </div>
                        <div>
                            <input name='food' id='food' type='text' style="width: 50px; font-size: 11px" title='Питание'>
                        </div>
                        <div>
                            <input name='work_clothes' id='work_clothes' type='text' style="width: 50px; font-size: 11px" title='Спецодежда'>
                        </div>
                        <div class='form-group col-md-10'>
                            <button type="submit" class="btn btn-outline-secondary float-left btn-sm">
                                {{ __('Сохранить') }}
                            </button>
                            @if(session('success'))
                                <a class='btn btn-outline-secondary btn-sm' style="margin-left: 10px;" href="{{ route('acc.base-timesheets.index') }}">{{ __('Закрыть') }}</a>
                            @else
                                <a class='btn btn-outline-secondary btn-sm' style="margin-left: 10px;" href="{{ route('acc.base-timesheets.index') }}">{{ __('Отмена') }}</a>
                            @endif
                        </div>
                    </div>
                </form>

        </div>
    </div>
@endsection