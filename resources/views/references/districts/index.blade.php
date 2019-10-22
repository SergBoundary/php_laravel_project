@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Districts $menu, $title, $districtsList */
        $country = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{ $title['name'] }}</small></h3><br />
                @if(count($districtsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th scope="col" colspan="2">Название области</th>
                        <th scope="col">Национальное название</th>
                        <th scope="col">Код ISO</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.districts.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($districtsList as $districtRow)
                        @if ($country != $districtRow->country)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>{{ $districtRow->country }}</em></td>
                        </tr>
                        @elseif ($country == $districtRow->country)
                        <tr>
                            <td> </td>
                            <td>{{ $districtRow->title }}</td>
                            <td>{{ $districtRow->national_name }}</td>
                            <td>{{ $districtRow->number_iso }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.districts.destroy', $districtRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.districts.show', $districtRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.districts.edit', $districtRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @php
                            $country = $districtRow->country;
                        @endphp
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