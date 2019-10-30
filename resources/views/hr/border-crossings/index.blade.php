@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\BorderCrossings $menu, $title, $borderCrossingsList */
        $personalCards = "";
        $countries = "";
        $countries = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($borderCrossingsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="4">Дата пересечения</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.border-crossings.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($borderCrossingsList as $borderCrossingsRow)
                        @if ($personalCards != $borderCrossingsRow->personal_card)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em> {{ $borderCrossingsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($countries != $borderCrossingsRow->country_out)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>  {{ $borderCrossingsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($countries != $borderCrossingsRow->country_in)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>   {{ $borderCrossingsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $borderCrossingsRow->date }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.border-crossings.destroy', $borderCrossingsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.border-crossings.show', $borderCrossingsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.border-crossings.edit', $borderCrossingsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $borderCrossingsRow->personal_card;
                            $countries = $borderCrossingsRow->country_out;
                            $countries = $borderCrossingsRow->country_in;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.border-crossings.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection