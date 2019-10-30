@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\AbsenceFromWorks $menu, $title, $absenceFromWorksList
         * @var \Illuminate\Database\Eloquent $personalCardsList, $absenceClassifiersList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('acc.absence-from-works.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('acc.absence-from-works.includes.result_messages')
                            <div class="row justify-content-center">
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
                                    <label for='start'>Начало периода отсутствия на работе</label>
                                    <input name='start' id='start' type='text' maxlength="50" class="form-control" title='Начало периода отсутствия на работе'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='expiry'>Окончание периода отсутствия на работе</label>
                                    <input name='expiry' id='expiry' type='text' maxlength="50" class="form-control" title='Окончание периода отсутствия на работе'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='rationale'>Обоснование отсутствия на работе</label>
                                    <input name='rationale' id='rationale' type='text' maxlength="50" class="form-control" title='Обоснование отсутствия на работе'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.absence-from-works.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.absence-from-works.index') }}">{{ __('Отмена') }}</a>
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