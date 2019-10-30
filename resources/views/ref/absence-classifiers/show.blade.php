@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\AbsenceClassifiers $menu, $title, $absenceClassifiersList */
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
                                    <label for='accrual'>Вид начиcления</label>
                                    <input name='accrual' value='{{ $absenceClassifiersList->accrual }}' id='accrual' type='text' maxlength="50" readonly class="form-control" title='Вид начиcления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='absences_grouping'>Группа причин невыхода</label>
                                    <input name='absences_grouping' value='{{ $absenceClassifiersList->absences_grouping }}' id='absences_grouping' type='text' maxlength="50" readonly class="form-control" title='Группа причин невыхода'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Название причины невыхода</label>
                                    <input name='title' value='{{ $absenceClassifiersList->title }}' id='title' type='text' maxlength="50" readonly class="form-control" title='Название причины невыхода'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='abbr'>Код невыхода</label>
                                    <input name='abbr' value='{{ $absenceClassifiersList->abbr }}' id='abbr' type='text' maxlength="50" readonly class="form-control" title='Код невыхода'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('ref.absence-classifiers.destroy', $absenceClassifiersList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.absence-classifiers.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.absence-classifiers.edit', $absenceClassifiersList->id) }}">{{ __('Изменить') }}</a>
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