@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Months $menu, $title, $monthsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{ $title }}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.months.update', $monthsList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('ref.months.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='number'>Номер месяца</label>
                                    <input name='number' value='{{ $monthsList->number }}' id='number' type='text' maxlength="50" class="form-control" title='Номер месяца'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Название месяца</label>
                                    <input name='title' value='{{ $monthsList->title }}' id='title' type='text' maxlength="50" class="form-control" title='Название месяца'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.months.show', $monthsList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.months.show', $monthsList->id) }}">{{ __('Отмена') }}</a>
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