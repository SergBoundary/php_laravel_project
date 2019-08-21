@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{$title}}</div>
                <div class="card-body">
                    <p>{{ $items }}</p>
                </div>
                
            </div>
        </div>
    </div>
</div>            
@endsection