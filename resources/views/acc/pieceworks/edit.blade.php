@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\Pieceworks $menu, $title, $team, $year, $month
         * @var \Illuminate\Database\Eloquent $pieceworksList, $personalCardsList, $yearsList, $monthsList, $objectsList
         */
        $team_id = 0;
        $personal_card_id = 0;
    @endphp

    <form method="POST" action="{{ route('acc.pieceworks.update', $id) }}">
        @method('PATCH')
        @csrf
        <div class="container">
            @php
                /** @var \Illuminate\Support\ViewErrorBag @errors */
            @endphp
            @include('acc.pieceworks.includes.result_messages')
            <div class="row justify-content">
                <div class="row col-md-12" style="margin-bottom: -10px;">
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
                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.pieceworks.index') }}"><img src="/img/visibility_off_black_18dp.png" alt="Закрыть" title="Закрыть"></a>
                                <button type="submit" class="btn btn-outline-success btn-sm">
                                    <img src="/img/save_black_18dp.png" alt="Сохранить" title="Сохранить">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content" style="width: 220%">
                <div class="row justify-content-center">
                    <div class='form-row col-md-12'>
                        <div class='form-row'>
                            <div>
                                <input name='personal_card' id='personal_card' value='Сотрудник' disabled class="form-control form-control-sm" style="width: 340px;" type='text' title='Работник'>
                           </div>
                            <div>
                                <input name='object' id='object' value='Объект' type='text' disabled class="form-control form-control-sm" style="width: 60px;" title='B-86 Polbet Warszawa'>
                            </div>
                        </div>
                        <div style="margin-left: 10px;">
                            <div class='form-row'>
                                <div>
                                    <input name='type' id='type' value='Вид работы' type='text' disabled class="form-control form-control-sm" style="width: 300px;" title='Вид работы'>
                                </div>
                                <div>
                                    <input name='unit' id='unit' value='Единица' type='text' disabled class="form-control form-control-sm" style="width: 80px;" title='Единица измерения'>
                                </div>
                                <div>
                                    <input name='quantity' id='quantity' value='Количество' type='text' disabled class="form-control form-control-sm" style="width: 100px;" title='Количество выполных работ'>
                                </div>
                                <div>
                                    <input name='price' id='price' value='Цена' type='text' disabled class="form-control form-control-sm" style="width: 80px;" title='Цена единицы'>
                                </div>
                            </div>
                        </div>
                        <div class='form-row' style="margin-left: 5px;">
                            <div>
                                <input name='total' id='total' value='Сумма' type='text' disabled class="form-control form-control-sm" style="width: 155px;" title='Итоговая сумма'>
                            </div>
                        </div>
                    </div>
                    @if(count($pieceworksList) > 0)
                    @php 
                        $order = 0; 
                    @endphp
                    @foreach($pieceworksList as $pieceworkRow)
                    @if($team_id != $pieceworkRow->team_id)
                    <div class='form-row col-md-12' style="margin-top: 5px">
                        <div class='form-row'>
                            <div>
                                <input name='department_team_{{ $order }}' id='department_team_{{ $order }}' value='{{ $pieceworkRow->department_title }} - {{ $pieceworkRow->team_title }}' disabled class="form-control form-control-sm department-team" style="width: 1115px; font-style: italic; font-weight: bold;" type='text' title='Подразделение - бригада'>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class='form-row col-md-12' style="margin-top: 5px">
                        @if($personal_card_id != $pieceworkRow->personal_card_id)
                        <div class='form-row'>
                            <div>
                                <input name='personal_card_{{ $order }}' id='personal_card_{{ $order }}' value='{{ $pieceworkRow->surname }} {{ $pieceworkRow->first_name }} {{ $pieceworkRow->second_name }}'  disabled class="form-control form-control-sm" style="width: 240px;" type='text' title='Работник'>
                                <input name='personal_card_id_{{ $order }}' id='personal_card_id_{{ $order }}' value='{{ $pieceworkRow->personal_card_id }}' type='hidden'>
                                <input name='id_{{ $order }}' id='id_{{ $order }}' value='{{ $pieceworkRow->id }}' type='hidden'>
                             </div>
                            <div>
                                <input name='personal_account_{{ $order }}' id='personal_account_{{ $order }}' value='{{ $pieceworkRow->personal_account }}' disabled class="form-control form-control-sm" style="width: 100px;" type='text' title='Работник'>
                            </div>
                            <div>
                                <input name='object_{{ $order }}' id='object_{{ $order }}' value='{{ $pieceworkRow->object_abbr }}' type='text'  disabled class="form-control form-control-sm" style="width: 60px;" title='{{ $pieceworkRow->object_title }}'>
                                <input name='object_id_{{ $order }}' id='object_id_{{ $order }}' value='{{ $pieceworkRow->object_id }}' type='hidden'>
                            </div>
                        </div>
                        @else
                        <div class='form-row'>
                            <div>
                                <input name='personal_card_{{ $order }}' id='personal_card_{{ $order }}' value=''  disabled class="form-control form-control-sm" style="width: 240px;" type='text' title='Работник'>
                                <input name='personal_card_id_{{ $order }}' id='personal_card_id_{{ $order }}' value='{{ $pieceworkRow->personal_card_id }}' type='hidden'>
                                <input name='id_{{ $order }}' id='id_{{ $order }}' value='{{ $pieceworkRow->id }}' type='hidden'>
                            </div>
                            <div>
                                <input name='personal_account_{{ $order }}' id='personal_account_{{ $order }}' value='' disabled class="form-control form-control-sm" style="width: 100px;" type='text' title='Работник'>
                            </div>
                            <div>
                                <input name='object_{{ $order }}' id='object_{{ $order }}' value='' type='text'  disabled class="form-control form-control-sm" style="width: 60px;" title='{{ $pieceworkRow->object_title }}'>
                                <input name='object_id_{{ $order }}' id='object_id_{{ $order }}' value='{{ $pieceworkRow->object_id }}' type='hidden'>
                            </div>
                        </div>
                        @endif
                        <div style="margin-left: 10px;">
                            <div class='form-row'>
                                <div>
                                    <input name='type_{{ $order }}' id='type_{{ $order }}' value='{{ $pieceworkRow->type }}' type='text' autocomplete="off" class="form-control form-control-sm calc-pieceworks-update" style="width: 300px;" title='Вид работы'>
                                </div>
                                <div>
                                    <input name='unit_{{ $order }}' id='unit_{{ $order }}' value='{{ $pieceworkRow->unit }}' type='text' autocomplete="off" class="form-control form-control-sm calc-pieceworks-update" style="width: 80px;" title='Единица измерения'>
                                </div>
                                <div>
                                    <input name='quantity_{{ $order }}' id='quantity_{{ $order }}' value='{{ $pieceworkRow->quantity }}' type='text' autocomplete="off" class="form-control form-control-sm calc-pieceworks-update" style="width: 100px;" title='Количество выполных работ'>
                                </div>
                                <div>
                                    <input name='price_{{ $order }}' id='price_{{ $order }}' value='{{ $pieceworkRow->price }}' type='text' autocomplete="off" class="form-control form-control-sm calc-pieceworks-update" style="width: 80px;" title='Цена единицы'>
                                </div>
                                <div>
                                    <input name='total_{{ $order }}' id='total_{{ $order }}' value='{{ $pieceworkRow->total }}' type='text' readonly class="form-control form-control-sm" style="width: 155px;" title='Итоговая сумма'>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php 
                        $order++; 
                        $team_id = $pieceworkRow->team_id;
                        $personal_card_id = $pieceworkRow->personal_card_id;
                    @endphp
                    @endforeach
                    @else	
                    <div class='form-row col-md-12' style="margin-top: 5px">
                        <div class='form-row'>
                            <div>
                                <input name='personal_card_id_0' id='personal_card_id_0' value='Нет прикрепленных сотрудников'  disabled class="form-control form-control-sm" style="width: 240px; height: 58px;" type='text' title='Работник'>
                            </div>
                            <div>
                                <input name='personal_account_0' id='personal_account_0' value='---'  disabled class="form-control form-control-sm" style="width: 100px; height: 58px;" type='text' title='Работник'>
                            </div>
                            <div>
                                <input name='object_id_0' id='object_id_0' value='---' type='text'  disabled class="form-control form-control-sm" style="width: 60px; height: 58px;" title='B-86 Polbet Warszawa'>
                            </div>
                        </div>
                        <div style="margin-left: 10px;">
                            <div class='form-row'>
                                <div>
                                    <input name='hours_auto_0' id='hours_auto_0' value="Часы:" type='text' readonly class="form-control form-control-sm auto-pieceworks" style="width: 70px; cursor: pointer;" title='Заполнить отработанные часы'>
                                </div>
                                @for ($i = 1; $i < 32; $i++)
                                <div>
                                    <input name='hours_day_{{ $i }}_0' id='hours_day_{{ $i }}_0' type='text' readonly class="form-control form-control-sm calc-pieceworks" style="width: 50px;" title='Часы {{ $i }}-го дня'>
                                </div>
                                @endfor
                                <div>
                                    <input name='hours_0' id='hours_0' value='0' type='text' readonly class="form-control form-control-sm" style="width: 60px;" title='Отработано часов'>
                                </div>
                            </div>
                            <div class='form-row'>
                                <div>
                                    <input name='rate_auto' id='rate_auto_0' value="Ставка:" type='text' readonly class="form-control form-control-sm auto-pieceworks" style="width: 70px; cursor: pointer;" title='Заполнить дневные ставки'>
                                </div>
                                @for ($i = 1; $i < 32; $i++)
                                <div>
                                    <input name='rate_day_{{ $i }}_0' id='rate_day_{{ $i }}_0' type='text' readonly class="form-control form-control-sm calc-pieceworks" style="width: 50px;" title='Цена часа {{ $i }}-го дня'>
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
    if(isset($pieceworksList)) { 
        if(count($pieceworksList) > 0) { 
            echo "<script type='text/javascript'>var gOrderCount = ".count($pieceworksList).";</script>";
        } else { 
            echo "<script type='text/javascript'>var gOrderCount = 0;</script>";
        }
    } else { 
        echo "<script type='text/javascript'>var gOrderCount = 0;</script>";
    }
    @endphp
@endsection