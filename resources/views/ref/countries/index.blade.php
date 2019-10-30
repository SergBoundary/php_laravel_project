@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\Countries $menu, $title, $countriesList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($countriesList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Название</th>
                        <th class="align-middle" scope="col">Национальное название</th>
                        <th class="align-middle" scope="col">Код Alfa 2</th>
                        <th class="align-middle" scope="col">Код Alfa 3</th>
                        <th class="align-middle" scope="col">Код ISO</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.countries.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($countriesList as $countriesRow)
                        <tr>
                            <td>{{ $countriesRow->title }}</td>
                            <td>{{ $countriesRow->national_name }}</td>
                            <td>{{ $countriesRow->symbol_alfa2 }}</td>
                            <td>{{ $countriesRow->symbol_alfa3 }}</td>
                            <td>{{ $countriesRow->number_iso }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.countries.destroy', $countriesRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.countries.show', $countriesRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.countries.edit', $countriesRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.countries.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection