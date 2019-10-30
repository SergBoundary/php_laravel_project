@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\Vacations $menu, $title, $vacationsList */
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
                                    <label for='document'>Приказ на отпуск</label>
                                    <input name='document' value='{{ $vacationsList->document }}' id='document' type='text' maxlength="50" readonly class="form-control" title='Приказ на отпуск'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='personal_card'>Работник</label>
                                    <input name='personal_card' value='{{ $vacationsList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='absence_classifier'>Вид отсутствия на работе</label>
                                    <input name='absence_classifier' value='{{ $vacationsList->absence_classifier }}' id='absence_classifier' type='text' maxlength="50" readonly class="form-control" title='Вид отсутствия на работе'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='period_start'>За период работы с даты</label>
                                    <input name='period_start' value='{{ $vacationsList->period_start }}' id='period_start' type='text' maxlength="50" readonly class="form-control" title='За период работы с даты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='period_expiry'>За период работы до даты</label>
                                    <input name='period_expiry' value='{{ $vacationsList->period_expiry }}' id='period_expiry' type='text' maxlength="50" readonly class="form-control" title='За период работы до даты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='perio'>Отработанные дни неоплачиваемого отпуска</label>
                                    <input name='perio' value='{{ $vacationsList->perio }}' id='perio' type='text' maxlength="50" readonly class="form-control" title='Отработанные дни неоплачиваемого отпуска'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='start'>Начало отпуска</label>
                                    <input name='start' value='{{ $vacationsList->start }}' id='start' type='text' maxlength="50" readonly class="form-control" title='Начало отпуска'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='expiry'>Конец отпуска</label>
                                    <input name='expiry' value='{{ $vacationsList->expiry }}' id='expiry' type='text' maxlength="50" readonly class="form-control" title='Конец отпуска'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='phrase_list'>Обоснование выхода в отпуск</label>
                                    <input name='phrase_list' value='{{ $vacationsList->phrase_list }}' id='phrase_list' type='text' maxlength="50" readonly class="form-control" title='Обоснование выхода в отпуск'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='work_days'>Количество рабочих дней в дни невыхода</label>
                                    <input name='work_days' value='{{ $vacationsList->work_days }}' id='work_days' type='text' maxlength="50" readonly class="form-control" title='Количество рабочих дней в дни невыхода'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='work_hours'>Количество рабочих часов в дни невыхода</label>
                                    <input name='work_hours' value='{{ $vacationsList->work_hours }}' id='work_hours' type='text' maxlength="50" readonly class="form-control" title='Количество рабочих часов в дни невыхода'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='vacation_pay'>Сумма отпускных или материальной помощи</label>
                                    <input name='vacation_pay' value='{{ $vacationsList->vacation_pay }}' id='vacation_pay' type='text' maxlength="50" readonly class="form-control" title='Сумма отпускных или материальной помощи'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('acc.vacations.destroy', $vacationsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.vacations.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.vacations.edit', $vacationsList->id) }}">{{ __('Изменить') }}</a>
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