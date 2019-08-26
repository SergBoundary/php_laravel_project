@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{$title['name']}}</div>
                <ul class="list-group list-group-flush">
                    @if(count($items) > 0)
                        @foreach($items as $item)
                        <li class="list-group-item">{{ $item->number_iso }} - {{ $item->title }} ( {{ $item->national_name }} )
                            <div class="btn-group" role="group">
                                <a class="btn btn-primary btn-sm" href="{{ url($title['url']) }}/{{ $item->id }}/update">Edit</a>
                                <a class="btn btn-primary btn-sm" href="#">Edit</a>
                            </div>
                        </li>
                        @endforeach
                    @else
                        <em>Данные отсутствуют..</em>
                    @endif
                </ul>
                
            </div>
        </div>
    </div>
</div>            
@endsection