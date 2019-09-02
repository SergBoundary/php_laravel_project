@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Districts $title, $paths, $districts */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">Выберите страну из списка</small></h3><br />
                @if(count($countryList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th scope="col">Название</th>
                        <th scope="col">Национальное название</th>
                        <th scope="col">Код Alfa2</th>
                        <th scope="col">Код Alfa2</th>
                        <th scope="col">Код ISO</th>
                        <th scope="col"></th>
                    </thead>
                    <tbody>
                        @foreach($countryList as $countryOption)
                        <tr>
                            <td>{{ $countryOption->title }}</th>
                            <td>{{ $countryOption->national_name }}</td>
                            <td>{{ $countryOption->symbol_alfa2 }}</td>
                            <td>{{ $countryOption->symbol_alfa3 }}</td>
                            <td>{{ $countryOption->number_iso }}</td>
                            <td>
                                <a class="btn btn-outline-primary btn-sm" href="{{ url($title['url']) }}/{{ $countryOption->id }}">Выбрать</a>
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