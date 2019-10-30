@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Settings\CalculationSetup $menu, $title, $calculationSetupList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($calculationSetupList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Название финансового параметра</th>
                        <th class="align-middle" scope="col">Значение параметра</th>
                        <th class="align-middle" scope="col">Дата и время включения</th>
                        <th class="align-middle" scope="col">Дата и время выключения</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('set.calculation-setup.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($calculationSetupList as $calculationSetupRow)
                        <tr>
                            <td>{{ $calculationSetupRow->title }}</td>
                            <td>{{ $calculationSetupRow->value }}</td>
                            <td>{{ $calculationSetupRow->start }}</td>
                            <td>{{ $calculationSetupRow->expiry }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('set.calculation-setup.destroy', $calculationSetupRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('set.calculation-setup.show', $calculationSetupRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('set.calculation-setup.edit', $calculationSetupRow->id) }}">{{ __('Изменить') }}</a>
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
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('set.calculation-setup.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection