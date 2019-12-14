@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\Retentions $menu, $title, $retentionsList */
        $personalCards = "";
        $years = "";
        $months = "";
        $retentionTypes = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3><small class="text-muted text-uppercase">{{ $title }}</small></h3><br />
                @if(count($retentionsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Сотрудник</th>
                        <th class="align-middle" scope="col">Т/н</th>
                        <th class="align-middle" scope="col">Год</th>
                        <th class="align-middle" scope="col">Месяц</th>
                        <th class="align-middle" scope="col">Счет</th>
                        <th class="align-middle" scope="col">Удержано</th>
                        <th scope="col">
                            @if ($access == 2)
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.retentions.create') }}"><img src="/img/add_black_18dp.png" alt="Добавить" title="Добавить"></a>
                            @endif
                        </th>
                    </thead>
                    <tbody>
                        @foreach($retentionsList as $retentionsRow)
                        <tr>
                            @if ($personalCards != $retentionsRow->personal_card)
                            <td>
                                {{ $retentionsRow->surname }} {{ $retentionsRow->first_name }}
                            </td>
                            <td>
                                {{ $retentionsRow->personal_card }}
                            </td>
                            @else
                            <td colspan="2"> </td>
                            @endif
                            <td>{{ $retentionsRow->year }}</td>
                            <td>{{ $retentionsRow->month }}</td>
                            <td>{{ $retentionsRow->retention_type }}</td>
                            <td>{{ $retentionsRow->amount }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    @if ($access == 2)
                                    <form method="POST" action="{{ route('acc.retentions.destroy', $retentionsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.retentions.show', $retentionsRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.retentions.edit', $retentionsRow->id) }}"><img src="/img/edit_black_18dp.png" alt="Изменить" title="Изменить"></a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#"><img src="/img/delete_black_18dp.png" alt="Удалить" title="Удалить"></button>
                                    </form>
                                    @endif
                                    @if ($access == 1)
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.retentions.show', $retentionsRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $retentionsRow->personal_card;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.retentions.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection