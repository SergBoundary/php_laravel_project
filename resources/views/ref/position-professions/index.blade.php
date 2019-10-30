@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\PositionProfessions $menu, $title, $positionProfessionsList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($positionProfessionsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Код профессии</th>
                        <th class="align-middle" scope="col">Название профессии</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.position-professions.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($positionProfessionsList as $positionProfessionsRow)
                        <tr>
                            <td>{{ $positionProfessionsRow->code }}</td>
                            <td>{{ $positionProfessionsRow->title }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.position-professions.destroy', $positionProfessionsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.position-professions.show', $positionProfessionsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.position-professions.edit', $positionProfessionsRow->id) }}">{{ __('Изменить') }}</a>
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
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.position-professions.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection