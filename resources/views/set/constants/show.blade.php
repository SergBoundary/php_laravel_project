@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Settings\Constants $menu, $title, $constantsList */
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
                                    <label for='title'>Название константы</label>
                                    <input name='title' value='{{ $constantsList->title }}' id='title' type='text' maxlength="50" readonly class="form-control" title='Название константы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='description'>Описание константы</label>
                                    <input name='description' value='{{ $constantsList->description }}' id='description' type='text' maxlength="50" readonly class="form-control" title='Описание константы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='value_number'>Числовой параметр</label>
                                    <input name='value_number' value='{{ $constantsList->value_number }}' id='value_number' type='text' maxlength="50" readonly class="form-control" title='Числовой параметр'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='value_string'>Строчный параметр</label>
                                    <input name='value_string' value='{{ $constantsList->value_string }}' id='value_string' type='text' maxlength="50" readonly class="form-control" title='Строчный параметр'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='start'>Дата и время включения константы</label>
                                    <input name='start' value='{{ $constantsList->start }}' id='start' type='text' maxlength="50" readonly class="form-control" title='Дата и время включения константы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='expiry'>Дата и время выключения константы</label>
                                    <input name='expiry' value='{{ $constantsList->expiry }}' id='expiry' type='text' maxlength="50" readonly class="form-control" title='Дата и время выключения константы'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('set.constants.destroy', $constantsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('set.constants.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('set.constants.edit', $constantsList->id) }}">{{ __('Изменить') }}</a>
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