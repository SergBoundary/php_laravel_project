@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{$title}}</div>
                <div class="card-body">
                    @if(count($items) > 0)
                        @foreach($items as $item)
                            <p>Запись #{{ $item->id }}</p>
                        @endforeach
                    @else
                        <em>Данные отсутствуют..</em>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</div>            
@endsection