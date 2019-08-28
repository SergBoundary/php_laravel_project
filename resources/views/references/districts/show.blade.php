@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Districts $title, $paths, $countryRow, $districtList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-uppercase">{{$countryRow['title']}}</small></h3><br />
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($districtList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th scope="col">Название</th>
                        <th scope="col">Национальное название</th>
                        <th scope="col">Код ISO</th>
                        <th scope="col"></th>
                    </thead>
                    <tbody>
                        @foreach($districtList as $districtRow)
                        <tr>
                            <td>{{ $districtRow->title }}</th>
                            <td>{{ $districtRow->national_name }}</td>
                            <td>{{ $districtRow->number_iso }}</td>
                            <td>
                                <a class="btn btn-outline-primary btn-sm" href="{{ url($title['url']) }}/{{ $districtRow->id }}/edit">Edit</a>
                                <a class="btn btn-outline-danger btn-sm" href="#">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <em>Данные отсутствуют..</em>
                @endif
            </div>
        </div>
    </div>            
@endsection