@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Settings\CalculationSetup $menu, $title, $calculationSetupList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('set.calculation-setup.update', $calculationSetupList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('set.calculation-setup.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='title'>Название финансового параметра</label>
                                    <input name='title' value='{{ $calculationSetupList->title }}' id='title' type='text' maxlength="50" class="form-control" title='Название финансового параметра'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='description'>Описание параметра</label>
                                    <input name='description' value='{{ $calculationSetupList->description }}' id='description' type='text' maxlength="50" class="form-control" title='Описание параметра'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='condition'>Условие применения</label>
                                    <input name='condition' value='{{ $calculationSetupList->condition }}' id='condition' type='text' maxlength="50" class="form-control" title='Условие применения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='value'>Значение параметра</label>
                                    <input name='value' value='{{ $calculationSetupList->value }}' id='value' type='text' maxlength="50" class="form-control" title='Значение параметра'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='start'>Дата и время включения</label>
                                    <input name='start' value='{{ $calculationSetupList->start }}' id='start' type='text' maxlength="50" class="form-control" title='Дата и время включения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='expiry'>Дата и время выключения</label>
                                    <input name='expiry' value='{{ $calculationSetupList->expiry }}' id='expiry' type='text' maxlength="50" class="form-control" title='Дата и время выключения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('set.calculation-setup.show', $calculationSetupList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('set.calculation-setup.show', $calculationSetupList->id) }}">{{ __('Отмена') }}</a>
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