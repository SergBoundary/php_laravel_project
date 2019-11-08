@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\Nationalities $menu, $title, $nationalitiesList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($nationalitiesList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Национальность</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.nationalities.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($nationalitiesList as $nationalitiesRow)
                        <tr>
                            <td>{{ $nationalitiesRow->title }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.nationalities.destroy', $nationalitiesRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.nationalities.show', $nationalitiesRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.nationalities.edit', $nationalitiesRow->id) }}">{{ __('Изменить') }}</a>
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
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.nationalities.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection