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
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.districts.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($districtList as $districtRow)
                        <tr>
                            <td>{{ $districtRow->title }}</th>
                            <td>{{ $districtRow->national_name }}</td>
                            <td>{{ $districtRow->number_iso }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.districts.edit', $districtRow->id) }}">Изменить</a>
                                    <form method="POST" action="{{ route('ref.districts.destroy', $districtRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">Удалить</button>
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