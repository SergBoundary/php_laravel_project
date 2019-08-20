@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <ol>
                @foreach($items as $item)
                    <li>{{ $item->title }}</li>
                @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>
            
@endsection