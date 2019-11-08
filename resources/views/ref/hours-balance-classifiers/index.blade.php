@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\HoursBalanceClassifiers $menu, $title, $hoursBalanceClassifiersList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($hoursBalanceClassifiersList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Название графика</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.hours-balance-classifiers.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($hoursBalanceClassifiersList as $hoursBalanceClassifiersRow)
                        <tr>
                            <td>{{ $hoursBalanceClassifiersRow->title }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.hours-balance-classifiers.destroy', $hoursBalanceClassifiersRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.hours-balance-classifiers.show', $hoursBalanceClassifiersRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.hours-balance-classifiers.edit', $hoursBalanceClassifiersRow->id) }}">{{ __('Изменить') }}</a>
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
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.hours-balance-classifiers.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection