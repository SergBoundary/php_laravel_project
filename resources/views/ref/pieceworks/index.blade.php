@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\Pieceworks $menu, $title, $pieceworksList */
        $pieceworksUnits = "";
        $accruals = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($pieceworksList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="3">Название сдельной работы</th>
                        <th class="align-middle" scope="col">Цена единицы</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.pieceworks.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($pieceworksList as $pieceworksRow)
                        @if ($pieceworksUnits != $pieceworksRow->pieceworks_unit)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em> {{ $pieceworksRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($accruals != $pieceworksRow->accrual)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>  {{ $pieceworksRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td>{{ $pieceworksRow->title }}</td>
                            <td>{{ $pieceworksRow->price }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.pieceworks.destroy', $pieceworksRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.pieceworks.show', $pieceworksRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.pieceworks.edit', $pieceworksRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $pieceworksUnits = $pieceworksRow->pieceworks_unit;
                            $accruals = $pieceworksRow->accrual;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.pieceworks.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection