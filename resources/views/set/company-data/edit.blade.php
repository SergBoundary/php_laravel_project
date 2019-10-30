@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Settings\CompanyData $menu, $title, $companyDataList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('set.company-data.update', $companyDataList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('set.company-data.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='title'>Название реквизита</label>
                                    <input name='title' value='{{ $companyDataList->title }}' id='title' type='text' maxlength="50" class="form-control" title='Название реквизита'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='description'>Описание реквизита</label>
                                    <input name='description' value='{{ $companyDataList->description }}' id='description' type='text' maxlength="50" class="form-control" title='Описание реквизита'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='data_short'>Краткое описание</label>
                                    <input name='data_short' value='{{ $companyDataList->data_short }}' id='data_short' type='text' maxlength="50" class="form-control" title='Краткое описание'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='data_full'>Полное описание</label>
                                    <input name='data_full' value='{{ $companyDataList->data_full }}' id='data_full' type='text' maxlength="50" class="form-control" title='Полное описание'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='start'>Начало действия</label>
                                    <input name='start' value='{{ $companyDataList->start }}' id='start' type='text' maxlength="50" class="form-control" title='Начало действия'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='expiry'>Окончание действия</label>
                                    <input name='expiry' value='{{ $companyDataList->expiry }}' id='expiry' type='text' maxlength="50" class="form-control" title='Окончание действия'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('set.company-data.show', $companyDataList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('set.company-data.show', $companyDataList->id) }}">{{ __('Отмена') }}</a>
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