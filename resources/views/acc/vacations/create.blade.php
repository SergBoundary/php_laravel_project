@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\Vacations $menu, $title, $vacationsList
         * @var \Illuminate\Database\Eloquent $documentsList, $personalCardsList, $absenceClassifiersList, $phraseListsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('acc.vacations.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('acc.vacations.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='document_id'>Приказ на отпуск</label>
                                    <div class="input-group mb-3"
>                                        <select name='document_id' value='document_id' id='document_id' type='text' placeholder="Приказ на отпуск" class="form-control" title='Приказ на отпуск' required>
                                            @foreach($documentsList as $documentsOption)
                                            <option value="{{ $documentsOption->id }}" >
                                                {{ $documentsOption->document }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('hr.documents.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='personal_card_id'>Работник</label>
                                    <div class="input-group mb-3"
>                                        <select name='personal_card_id' value='personal_card_id' id='personal_card_id' type='text' placeholder="Работник" class="form-control" title='Работник' required>
                                            @foreach($personalCardsList as $personalCardsOption)
                                            <option value="{{ $personal_cardsOption->id }}" >
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
                                    <label for='absence_classifier_id'>Вид отсутствия на работе</label>
                                    <div class="input-group mb-3"
>                                        <select name='absence_classifier_id' value='absence_classifier_id' id='absence_classifier_id' type='text' placeholder="Вид отсутствия на работе" class="form-control" title='Вид отсутствия на работе' required>
                                            @foreach($absenceClassifiersList as $absenceClassifiersOption)
                                            <option value="{{ $absence_classifiersOption->id }}" >
                                                {{ $absenceClassifiersOption->absence_classifier }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.absence-classifiers.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='phrase_list_id'>Обоснование выхода в отпуск</label>
                                    <div class="input-group mb-3"
>                                        <select name='phrase_list_id' value='phrase_list_id' id='phrase_list_id' type='text' placeholder="Обоснование выхода в отпуск" class="form-control" title='Обоснование выхода в отпуск' required>
                                            @foreach($phraseListsList as $phraseListsOption)
                                            <option value="{{ $phrase_listsOption->id }}" >
                                                {{ $phraseListsOption->phrase_list }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.phrase-lists.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='period_start'>За период работы с даты</label>
                                    <input name='period_start' id='period_start' type='text' maxlength="50" class="form-control" title='За период работы с даты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='period_expiry'>За период работы до даты</label>
                                    <input name='period_expiry' id='period_expiry' type='text' maxlength="50" class="form-control" title='За период работы до даты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='period'>Отработанные дни неоплачиваемого отпуска</label>
                                    <input name='period' id='period' type='text' maxlength="50" class="form-control" title='Отработанные дни неоплачиваемого отпуска'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='start'>Начало отпуска</label>
                                    <input name='start' id='start' type='text' maxlength="50" class="form-control" title='Начало отпуска'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='expiry'>Конец отпуска</label>
                                    <input name='expiry' id='expiry' type='text' maxlength="50" class="form-control" title='Конец отпуска'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='work_days'>Количество рабочих дней в дни невыхода</label>
                                    <input name='work_days' id='work_days' type='text' maxlength="50" class="form-control" title='Количество рабочих дней в дни невыхода'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='work_hours'>Количество рабочих часов в дни невыхода</label>
                                    <input name='work_hours' id='work_hours' type='text' maxlength="50" class="form-control" title='Количество рабочих часов в дни невыхода'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='vacation_pay'>Сумма отпускных или материальной помощи</label>
                                    <input name='vacation_pay' id='vacation_pay' type='text' maxlength="50" class="form-control" title='Сумма отпускных или материальной помощи'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.vacations.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.vacations.index') }}">{{ __('Отмена') }}</a>
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