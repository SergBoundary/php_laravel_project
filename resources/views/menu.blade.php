@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if(count($items) > 0)
                    @foreach($items as $item)
                        <a class='btn btn-outline-secondary btn-toolbar btn-lg' href='{{ url($item->url) }}'>{{ $item->name }}</a><br>
                    @endforeach
                @else
                    <em>Данные отсутствуют..</em>
                    <a class='btn btn-outline-secondary btn-toolbar btn-lg' href='{{ url('human-resources') }}'>Кадры</a><br>
                    <a class='btn btn-outline-secondary btn-toolbar btn-lg' href='{{ url('accounting') }}'>Финансы</a><br>
                    <a class='btn btn-outline-secondary btn-toolbar btn-lg' href='{{ url('references') }}'>Справочники</a><br>
                    <a class='btn btn-outline-secondary btn-toolbar btn-lg' href='{{ url('settings') }}'>Настройки</a>
                @endif
            </div>
        </div>
    </div>
            
@endsection