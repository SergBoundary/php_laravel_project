@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Countries $title, $paths, $countries */
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
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.countries.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($countryList as $countryRow)
                        <tr>
                            <td>{{ $countryRow->title }}</th>
                            <td>{{ $countryRow->national_name }}</td>
                            <td>{{ $countryRow->symbol_alfa2 }}</td>
                            <td>{{ $countryRow->symbol_alfa3 }}</td>
                            <td>{{ $countryRow->number_iso }}</td>
                            <td>
                                <a class="btn btn-outline-primary btn-sm" href="{{ url($title['url']) }}/{{ $countryRow->id }}/edit">Изменить</a>
                                <a class="btn btn-outline-danger btn-sm" href="#">Удалить</a>
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