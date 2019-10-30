@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\TaxOffices $menu, $title, $taxOfficesList */
        $countries = "";
        $districts = "";
        $regions = "";
        $cities = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($taxOfficesList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="5">Налоговая инспекция</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.tax-offices.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($taxOfficesList as $taxOfficesRow)
                        @if ($countries != $taxOfficesRow->country)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em> {{ $taxOfficesRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($districts != $taxOfficesRow->district)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>  {{ $taxOfficesRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($regions != $taxOfficesRow->region)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>   {{ $taxOfficesRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($cities != $taxOfficesRow->city)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>    {{ $taxOfficesRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $taxOfficesRow->title }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.tax-offices.destroy', $taxOfficesRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.tax-offices.show', $taxOfficesRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.tax-offices.edit', $taxOfficesRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $countries = $taxOfficesRow->country;
                            $districts = $taxOfficesRow->district;
                            $regions = $taxOfficesRow->region;
                            $cities = $taxOfficesRow->city;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.tax-offices.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection