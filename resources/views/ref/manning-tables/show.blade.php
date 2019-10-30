@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\ManningTables $menu, $title, $manningTablesList */
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
                                    <label for='department'>Подразделение</label>
                                    <input name='department' value='{{ $manningTablesList->department }}' id='department' type='text' maxlength="50" readonly class="form-control" title='Подразделение'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='position'>Должность</label>
                                    <input name='position' value='{{ $manningTablesList->position }}' id='position' type='text' maxlength="50" readonly class="form-control" title='Должность'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='rank'>Уровень квалификации</label>
                                    <input name='rank' value='{{ $manningTablesList->rank }}' id='rank' type='text' maxlength="50" readonly class="form-control" title='Уровень квалификации'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='quantity'>Количество работников в штате</label>
                                    <input name='quantity' value='{{ $manningTablesList->quantity }}' id='quantity' type='text' maxlength="50" readonly class="form-control" title='Количество работников в штате'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='salary'>Оклад</label>
                                    <input name='salary' value='{{ $manningTablesList->salary }}' id='salary' type='text' maxlength="50" readonly class="form-control" title='Оклад'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tariff'>Тариф</label>
                                    <input name='tariff' value='{{ $manningTablesList->tariff }}' id='tariff' type='text' maxlength="50" readonly class="form-control" title='Тариф'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('ref.manning-tables.destroy', $manningTablesList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.manning-tables.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.manning-tables.edit', $manningTablesList->id) }}">{{ __('Изменить') }}</a>
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