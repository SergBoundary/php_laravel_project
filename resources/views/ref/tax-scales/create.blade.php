@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\TaxScales $menu, $title, $taxScalesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.tax-scales.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('ref.tax-scales.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='title'>Описание диапазона</label>
                                    <input name='title' id='title' type='text' maxlength="50" class="form-control" title='Описание диапазона'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='lower amount'>Нижняя сумма диапазона</label>
                                    <input name='lower amount' id='lower amount' type='text' maxlength="50" class="form-control" title='Нижняя сумма диапазона'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='top amount'>Верхняя сумма диапазона</label>
                                    <input name='top amount' id='top amount' type='text' maxlength="50" class="form-control" title='Верхняя сумма диапазона'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tax percentage'>Процент налога</label>
                                    <input name='tax percentage' id='tax percentage' type='text' maxlength="50" class="form-control" title='Процент налога'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.tax-scales.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.tax-scales.index') }}">{{ __('Отмена') }}</a>
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