@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\Regions $menu, $title, $regionsList */
        $countries = "";
        $districts = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($regionsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="3">Название района</th>
                        <th class="align-middle" scope="col">Национальное название района</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.regions.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($regionsList as $regionsRow)
                        @if ($countries != $regionsRow->country)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em> {{ $regionsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($districts != $regionsRow->district)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>  {{ $regionsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td>{{ $regionsRow->title }}</td>
                            <td>{{ $regionsRow->national_name }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.regions.destroy', $regionsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.regions.show', $regionsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.regions.edit', $regionsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $countries = $regionsRow->country;
                            $districts = $regionsRow->district;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.regions.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection