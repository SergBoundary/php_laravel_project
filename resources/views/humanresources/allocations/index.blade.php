@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Countries $title, $paths, $countries */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">Страны</small></h3><br />
                @if(count($countryList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th scope="col">Название</th>
                        <th scope="col">Национальное название</th>
                        <th scope="col">Код Alfa2</th>
                        <th scope="col">Код Alfa2</th>
                        <th scope="col">Код ISO</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.allocations.create') }}">{{ __('Добавить') }}</a>
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
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <a class="btn btn-outline-primary btn-sm" href="{{ url($title['url']) }}/{{ $countryRow->id }}/edit">{{ __('Изменить') }}</a>
                                    <form method="POST" action="{{ route('hr.allocations.destroy', $countryRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
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