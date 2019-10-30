@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Settings\RestoreDatabase $menu, $title, $restoreDatabaseList */
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
                                    <input name='title' value='{{ $restoreDatabaseList->title }}' id='title' type='text' maxlength="50" readonly class="form-control" title='Название параметра'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='description'>Описание параметра</label>
                                    <input name='description' value='{{ $restoreDatabaseList->description }}' id='description' type='text' maxlength="50" readonly class="form-control" title='Описание параметра'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='module'>Ответственный модуль</label>
                                    <input name='module' value='{{ $restoreDatabaseList->module }}' id='module' type='text' maxlength="50" readonly class="form-control" title='Ответственный модуль'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='comman'>Выполняемая команда</label>
                                    <input name='comman' value='{{ $restoreDatabaseList->comman }}' id='comman' type='text' maxlength="50" readonly class="form-control" title='Выполняемая команда'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='parametr'>Параметр выполнения команды</label>
                                    <input name='parametr' value='{{ $restoreDatabaseList->parametr }}' id='parametr' type='text' maxlength="50" readonly class="form-control" title='Параметр выполнения команды'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='condition'>Условие запуска команды</label>
                                    <input name='condition' value='{{ $restoreDatabaseList->condition }}' id='condition' type='text' maxlength="50" readonly class="form-control" title='Условие запуска команды'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('set.restore-database.destroy', $restoreDatabaseList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('set.restore-database.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('set.restore-database.edit', $restoreDatabaseList->id) }}">{{ __('Изменить') }}</a>
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