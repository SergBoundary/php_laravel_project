@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\HoursBalanceClassifiers $menu, $title, $hoursBalanceClassifiersList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.hours-balance-classifiers.update', $hoursBalanceClassifiersList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('ref.hours-balance-classifiers.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='title'>Название графика</label>
                                    <input name='title' value='{{ $hoursBalanceClassifiersList->title }}' id='title' type='text' maxlength="50" class="form-control" title='Название графика'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='monday_day'>День понедельника</label>
                                    <input name='monday_day' value='{{ $hoursBalanceClassifiersList->monday_day }}' id='monday_day' type='text' maxlength="50" class="form-control" title='День понедельника'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tuesday_day'>День вторника</label>
                                    <input name='tuesday_day' value='{{ $hoursBalanceClassifiersList->tuesday_day }}' id='tuesday_day' type='text' maxlength="50" class="form-control" title='День вторника'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='wednesday_day'>День среды</label>
                                    <input name='wednesday_day' value='{{ $hoursBalanceClassifiersList->wednesday_day }}' id='wednesday_day' type='text' maxlength="50" class="form-control" title='День среды'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='thursday_day'>День четверга</label>
                                    <input name='thursday_day' value='{{ $hoursBalanceClassifiersList->thursday_day }}' id='thursday_day' type='text' maxlength="50" class="form-control" title='День четверга'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='friday_day'>День пятницы</label>
                                    <input name='friday_day' value='{{ $hoursBalanceClassifiersList->friday_day }}' id='friday_day' type='text' maxlength="50" class="form-control" title='День пятницы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='saturday_day'>День субботы</label>
                                    <input name='saturday_day' value='{{ $hoursBalanceClassifiersList->saturday_day }}' id='saturday_day' type='text' maxlength="50" class="form-control" title='День субботы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='sunday_day'>День воскресенья</label>
                                    <input name='sunday_day' value='{{ $hoursBalanceClassifiersList->sunday_day }}' id='sunday_day' type='text' maxlength="50" class="form-control" title='День воскресенья'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hours_reduction'>Сокращение часов</label>
                                    <input name='hours_reduction' value='{{ $hoursBalanceClassifiersList->hours_reduction }}' id='hours_reduction' type='text' maxlength="50" class="form-control" title='Сокращение часов'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hourly_rate'>Ставка за час</label>
                                    <input name='hourly_rate' value='{{ $hoursBalanceClassifiersList->hourly_rate }}' id='hourly_rate' type='text' maxlength="50" class="form-control" title='Ставка за час'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='period'>Количество дней в периоде</label>
                                    <input name='period' value='{{ $hoursBalanceClassifiersList->period }}' id='period' type='text' maxlength="50" class="form-control" title='Количество дней в периоде'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='monday_evening'>Вечер понедельника</label>
                                    <input name='monday_evening' value='{{ $hoursBalanceClassifiersList->monday_evening }}' id='monday_evening' type='text' maxlength="50" class="form-control" title='Вечер понедельника'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tuesday_evening'>Вечер вторника</label>
                                    <input name='tuesday_evening' value='{{ $hoursBalanceClassifiersList->tuesday_evening }}' id='tuesday_evening' type='text' maxlength="50" class="form-control" title='Вечер вторника'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='wednesday_evening'>Вечер среды</label>
                                    <input name='wednesday_evening' value='{{ $hoursBalanceClassifiersList->wednesday_evening }}' id='wednesday_evening' type='text' maxlength="50" class="form-control" title='Вечер среды'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='thursday_evening'>Вечер четверга</label>
                                    <input name='thursday_evening' value='{{ $hoursBalanceClassifiersList->thursday_evening }}' id='thursday_evening' type='text' maxlength="50" class="form-control" title='Вечер четверга'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='friday_evening'>Вечер пятницы</label>
                                    <input name='friday_evening' value='{{ $hoursBalanceClassifiersList->friday_evening }}' id='friday_evening' type='text' maxlength="50" class="form-control" title='Вечер пятницы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='saturday_evening'>Вечер субботы</label>
                                    <input name='saturday_evening' value='{{ $hoursBalanceClassifiersList->saturday_evening }}' id='saturday_evening' type='text' maxlength="50" class="form-control" title='Вечер субботы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='sunday_evening'>Вечер воскресенья</label>
                                    <input name='sunday_evening' value='{{ $hoursBalanceClassifiersList->sunday_evening }}' id='sunday_evening' type='text' maxlength="50" class="form-control" title='Вечер воскресенья'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='monday_night'>Ночь понедельника</label>
                                    <input name='monday_night' value='{{ $hoursBalanceClassifiersList->monday_night }}' id='monday_night' type='text' maxlength="50" class="form-control" title='Ночь понедельника'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tuesday_night'>Ночь вторника</label>
                                    <input name='tuesday_night' value='{{ $hoursBalanceClassifiersList->tuesday_night }}' id='tuesday_night' type='text' maxlength="50" class="form-control" title='Ночь вторника'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='wednesday_night'>Ночь среды</label>
                                    <input name='wednesday_night' value='{{ $hoursBalanceClassifiersList->wednesday_night }}' id='wednesday_night' type='text' maxlength="50" class="form-control" title='Ночь среды'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='thursday_night'>Ночь четверга</label>
                                    <input name='thursday_night' value='{{ $hoursBalanceClassifiersList->thursday_night }}' id='thursday_night' type='text' maxlength="50" class="form-control" title='Ночь четверга'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='friday_night'>Ночь пятницы</label>
                                    <input name='friday_night' value='{{ $hoursBalanceClassifiersList->friday_night }}' id='friday_night' type='text' maxlength="50" class="form-control" title='Ночь пятницы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='saturday_night'>Ночь субботы</label>
                                    <input name='saturday_night' value='{{ $hoursBalanceClassifiersList->saturday_night }}' id='saturday_night' type='text' maxlength="50" class="form-control" title='Ночь субботы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='sunday_night'>Ночь воскресенья</label>
                                    <input name='sunday_night' value='{{ $hoursBalanceClassifiersList->sunday_night }}' id='sunday_night' type='text' maxlength="50" class="form-control" title='Ночь воскресенья'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.hours-balance-classifiers.show', $hoursBalanceClassifiersList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.hours-balance-classifiers.show', $hoursBalanceClassifiersList->id) }}">{{ __('Отмена') }}</a>
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