@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Objects $menu, $title, $objectsList
         * @var \Illuminate\Database\Eloquent $objectGroupsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{ $title }}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.objects.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('ref.objects.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='code'>Код объекта</label>
                                    <input name='code' id='code' type='text' maxlength="50" class="form-control" title='Код объекта'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Объект выполнения работ</label>
                                    <input name='title' id='title' type='text' maxlength="50" class="form-control" title='Объект выполнения работ'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='abbr'>Аббривиатура</label>
                                    <input name='abbr' id='abbr' type='text' maxlength="50" class="form-control" title='Аббривиатура'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.objects.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.objects.index') }}">{{ __('Отмена') }}</a>
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