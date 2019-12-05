@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\Pieceworks $menu, $title, $pieceworksList */
        $personalCards = "";
        $years = "";
        $months = "";
        $objects = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($pieceworksList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="2">Год</th>
                        <th class="align-middle" scope="col">Месяц</th>
                        <th class="align-middle" scope="col">Объект</th>
                        <th class="align-middle" scope="col">Работа</th>
                        <th class="align-middle" scope="col">Единица</th>
                        <th class="align-middle" scope="col">Количество</th>
                        <th class="align-middle" scope="col">Цена</th>
                        <th class="align-middle" scope="col">Сумма</th>
                        <th scope="col">
						    @if ($access == 2)
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.pieceworks.create') }}"><img src="/img/add_black_18dp.png" alt="Добавить" title="Добавить"></a>
						    @endif
                        </th>
                    </thead>
                    <tbody>
                        @foreach($pieceworksList as $pieceworksRow)
                        @if ($personalCards != $pieceworksRow->personal_card)
                        <tr>
                            <td colspan="9" class="text-muted text-uppercase"><em>{{ $pieceworksRow->personal_card }}, {{ $pieceworksRow->surname }} {{ $pieceworksRow->first_name }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td>{{ $pieceworksRow->year }}</td>
                            <td>{{ $pieceworksRow->month }}</td>
                            <td>{{ $pieceworksRow->object }}</td>
                            <td>{{ $pieceworksRow->type }}</td>
                            <td>{{ $pieceworksRow->unit }}</td>
                            <td>{{ $pieceworksRow->quantity }}</td>
                            <td>{{ $pieceworksRow->price }}</td>
                            <td>{{ $pieceworksRow->quantity * $pieceworksRow->price }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    @if ($access == 2)
                                    <form method="POST" action="{{ route('acc.pieceworks.destroy', $pieceworksRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.pieceworks.show', $pieceworksRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.pieceworks.edit', $pieceworksRow->id) }}"><img src="/img/edit_black_18dp.png" alt="Изменить" title="Изменить"></a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#"><img src="/img/delete_black_18dp.png" alt="Удалить" title="Удалить"></button>
                                    </form>
                                    @endif
                                    @if ($access == 1)
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.pieceworks.show', $pieceworksRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $pieceworksRow->personal_card;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.pieceworks.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection