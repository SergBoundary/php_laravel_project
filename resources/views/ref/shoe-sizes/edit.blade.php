@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\ShoeSizes $menu, $title, $shoeSizesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.shoe-sizes.update', $shoeSizesList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('ref.shoe-sizes.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='title'>Размер обуви</label>
                                    <input name='title' value='{{ $shoeSizesList->title }}' id='title' type='text' maxlength="50" class="form-control" title='Размер обуви'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.shoe-sizes.show', $shoeSizesList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.shoe-sizes.show', $shoeSizesList->id) }}">{{ __('Отмена') }}</a>
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