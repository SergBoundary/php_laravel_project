@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Settings\SaveDatabase $menu, $title, $saveDatabaseList */
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
                                    <label for='title'>Название параметра</label>
                                    <input name='title' value='{{ $saveDatabaseList->title }}' id='title' type='text' maxlength="50" readonly class="form-control" title='Название параметра'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='description'>Описание параметра</label>
                                    <input name='description' value='{{ $saveDatabaseList->description }}' id='description' type='text' maxlength="50" readonly class="form-control" title='Описание параметра'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='module'>Ответственный модуль</label>
                                    <input name='module' value='{{ $saveDatabaseList->module }}' id='module' type='text' maxlength="50" readonly class="form-control" title='Ответственный модуль'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='comman'>Выполняемая команда</label>
                                    <input name='comman' value='{{ $saveDatabaseList->comman }}' id='comman' type='text' maxlength="50" readonly class="form-control" title='Выполняемая команда'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='parametr'>Параметры выполнения команды</label>
                                    <input name='parametr' value='{{ $saveDatabaseList->parametr }}' id='parametr' type='text' maxlength="50" readonly class="form-control" title='Параметры выполнения команды'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='start'>Дата и время включения параметра</label>
                                    <input name='start' value='{{ $saveDatabaseList->start }}' id='start' type='text' maxlength="50" readonly class="form-control" title='Дата и время включения параметра'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='expiry'>Дата и время выключения параметра</label>
                                    <input name='expiry' value='{{ $saveDatabaseList->expiry }}' id='expiry' type='text' maxlength="50" readonly class="form-control" title='Дата и время выключения параметра'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='month_day'>День месяца запуска команды</label>
                                    <input name='month_day' value='{{ $saveDatabaseList->month_day }}' id='month_day' type='text' maxlength="50" readonly class="form-control" title='День месяца запуска команды'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='week_day'>День недели запуска команды</label>
                                    <input name='week_day' value='{{ $saveDatabaseList->week_day }}' id='week_day' type='text' maxlength="50" readonly class="form-control" title='День недели запуска команды'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='run_time'>Время запуска команды</label>
                                    <input name='run_time' value='{{ $saveDatabaseList->run_time }}' id='run_time' type='text' maxlength="50" readonly class="form-control" title='Время запуска команды'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='condition'>Условие экстренного запуска команды</label>
                                    <input name='condition' value='{{ $saveDatabaseList->condition }}' id='condition' type='text' maxlength="50" readonly class="form-control" title='Условие экстренного запуска команды'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('set.save-database.destroy', $saveDatabaseList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('set.save-database.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('set.save-database.edit', $saveDatabaseList->id) }}">{{ __('Изменить') }}</a>
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