@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\Holidays $menu, $title, $holidaysList */
        $countries = "";
        $years = "";
        $months = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($holidaysList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="4">Праздничный день</th>
                        <th class="align-middle" scope="col">Не рабочий</th>
                        <th class="align-middle" scope="col">Религиозный</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.holidays.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($holidaysList as $holidaysRow)
                        @if ($countries != $holidaysRow->country)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em> {{ $holidaysRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($years != $holidaysRow->year)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>  {{ $holidaysRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($months != $holidaysRow->month)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>   {{ $holidaysRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $holidaysRow->holiday }}</td>
                            <td>{{ $holidaysRow->not_work }}</td>
                            <td>{{ $holidaysRow->religion }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.holidays.destroy', $holidaysRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.holidays.show', $holidaysRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.holidays.edit', $holidaysRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $countries = $holidaysRow->country;
                            $years = $holidaysRow->year;
                            $months = $holidaysRow->month;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.holidays.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection