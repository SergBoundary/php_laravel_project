@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Settings\Constants $menu, $title, $constantsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('set.constants.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('set.constants.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='title'>Название константы</label>
                                    <input name='title' id='title' type='text' maxlength="50" class="form-control" title='Название константы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='description'>Описание константы</label>
                                    <input name='description' id='description' type='text' maxlength="50" class="form-control" title='Описание константы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='value_number'>Числовой параметр</label>
                                    <input name='value_number' id='value_number' type='text' maxlength="50" class="form-control" title='Числовой параметр'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='value_string'>Строчный параметр</label>
                                    <input name='value_string' id='value_string' type='text' maxlength="50" class="form-control" title='Строчный параметр'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='start'>Дата и время включения константы</label>
                                    <input name='start' id='start' type='text' maxlength="50" class="form-control" title='Дата и время включения константы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='expiry'>Дата и время выключения константы</label>
                                    <input name='expiry' id='expiry' type='text' maxlength="50" class="form-control" title='Дата и время выключения константы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('set.constants.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('set.constants.index') }}">{{ __('Отмена') }}</a>
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