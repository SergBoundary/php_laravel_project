@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\Positions $menu, $title, $positionsList */
        $subordinations = "";
        $positionProfessions = "";
        $positionCategories = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($positionsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="4">Название должности</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.positions.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($positionsList as $positionsRow)
                        @if ($subordinations != $positionsRow->subordination)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em> {{ $positionsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($positionProfessions != $positionsRow->position_profession)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>  {{ $positionsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($positionCategories != $positionsRow->position_category)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>   {{ $positionsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $positionsRow->title }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.positions.destroy', $positionsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.positions.show', $positionsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.positions.edit', $positionsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $subordinations = $positionsRow->subordination;
                            $positionProfessions = $positionsRow->position_profession;
                            $positionCategories = $positionsRow->position_category;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.positions.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection