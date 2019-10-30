@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\Districts $menu, $title, $districtsList */
        $countries = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($districtsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="2">Название области</th>
                        <th class="align-middle" scope="col">Национальное название области</th>
                        <th class="align-middle" scope="col">Код области</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.districts.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($districtsList as $districtsRow)
                        @if ($countries != $districtsRow->country)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em> {{ $districtsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td>{{ $districtsRow->title }}</td>
                            <td>{{ $districtsRow->national_name }}</td>
                            <td>{{ $districtsRow->number_iso }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                </div>
                            </td>
                        </tr>
                        @php
                            $countries = $districtsRow->country;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.districts.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection