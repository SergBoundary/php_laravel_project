@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\Cities $menu, $title, $citiesList */
        $countries = "";
        $districts = "";
        $regions = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($citiesList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="4">Населенный пунк</th>
                        <th class="align-middle" scope="col">Национальное название населенного пункта</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.cities.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($citiesList as $citiesRow)
                        @if ($countries != $citiesRow->country)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>{{ $citiesRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($districts != $citiesRow->district)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>&nbsp;&nbsp;&nbsp;{{ $citiesRow->district }}</em></td>
                        </tr>
                        @endif
                        @if ($regions != $citiesRow->region)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $citiesRow->region }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $citiesRow->title }}</td>
                            <td>{{ $citiesRow->national_name }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.cities.destroy', $citiesRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.cities.show', $citiesRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.cities.edit', $citiesRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $countries = $citiesRow->country;
                            $districts = $citiesRow->district;
                            $regions = $citiesRow->region;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.cities.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection