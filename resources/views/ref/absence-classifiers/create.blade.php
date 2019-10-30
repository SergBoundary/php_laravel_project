@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\AbsenceClassifiers $menu, $title, $absenceClassifiersList
         * @var \Illuminate\Database\Eloquent $accrualsList, $groupingTypesOfAbsencesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.absence-classifiers.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('ref.absence-classifiers.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='accrual_id'>Вид начиcления</label>
                                    <div class="input-group mb-3"
>                                        <select name='accrual_id' value='accrual_id' id='accrual_id' type='text' placeholder="Вид начиcления" class="form-control" title='Вид начиcления' required>
                                            @foreach($accrualsList as $accrualsOption)
                                            <option value="{{ $accrualsOption->id }}" >
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
                                    <label for='absences_grouping_id'>Группа причин невыхода</label>
                                    <div class="input-group mb-3"
>                                        <select name='absences_grouping_id' value='absences_grouping_id' id='absences_grouping_id' type='text' placeholder="Группа причин невыхода" class="form-control" title='Группа причин невыхода' required>
                                            @foreach($groupingTypesOfAbsencesList as $groupingTypesOfAbsencesOption)
                                            <option value="{{ $groupingTypesOfAbsencesOption->id }}" >
                                                {{ $groupingTypesOfAbsencesOption->absences_grouping }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.grouping-types-of-absences.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Название причины невыхода</label>
                                    <input name='title' id='title' type='text' maxlength="50" class="form-control" title='Название причины невыхода'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='abbr'>Код невыхода</label>
                                    <input name='abbr' id='abbr' type='text' maxlength="50" class="form-control" title='Код невыхода'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.absence-classifiers.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.absence-classifiers.index') }}">{{ __('Отмена') }}</a>
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