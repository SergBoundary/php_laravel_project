@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\BaseTimesheets $menu, $title, $baseTimesheetsList */
        $years = "";
        $months = "";
        $teams = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            @include('acc.base-timesheets.includes.result_messages')
            <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="mr-auto">
                            <h2><small class="text-muted text-uppercase">{{ $title }}</small></h2><br />
                        </div>
                        <div class="form-row ml-auto">
                        <form method="POST" action="{{ route('acc.base-timesheets.index') }}">
                        @method('GET')
                        @csrf
                            <button type="submit" class="btn btn-outline-secondary btn-sm" href="#">Обновить список табелей</button>
                        </form>
                        </div>
                    </div>
                </div>
               @if(count($baseTimesheetsList) > 0)
                <table class="table table-hover table-bordered">
                    <thead>
                        <th class="align-middle" scope="col">Год</th>
                        <th class="align-middle" scope="col">Месяц</th>
                        <th class="align-middle" scope="col">Бригада</th>
                        <th class="align-middle" scope="col">Почасово</th>
                        <th class="align-middle" scope="col">Сдельно</th>
                        <th class="align-middle" scope="col">Итоговая сумма</th>
                        <th scope="col">
                        </th>
                    </thead>
                    <tbody>
                        @foreach($baseTimesheetsList as $baseTimesheetRow)
                        @php
                            $id = $baseTimesheetRow->team_id."-".$baseTimesheetRow->year_id."-".$baseTimesheetRow->month_id
                        @endphp
                        @if ($baseTimesheetRow->total == 0)
                        <tr class="text-danger">
                        @elseif ($baseTimesheetRow->total != 0)
                        <tr>
                        @endif
                            @if ($years == $baseTimesheetRow->year_id 
                            && $months == $baseTimesheetRow->month_id)
                            <td colspan="2"> </td>
                            @elseif ($years == $baseTimesheetRow->year_id)
                            <td> </td>
                            <td>{{ $baseTimesheetRow->month }}</td>
                            @else
                            <td>{{ $baseTimesheetRow->year }}</td>
                            <td>{{ $baseTimesheetRow->month }}</td>
                            @endif
                            <td>{{ $baseTimesheetRow->team }}</td>
                            <td>{{ $baseTimesheetRow->hourly }}</td>
                            <td>{{ $baseTimesheetRow->piecework }}</td>
                            <td>{{ $baseTimesheetRow->total }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    @if ($access == 2)
                                    <form method="POST" action="{{ route('acc.base-timesheets.destroy', $id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.base-timesheets.show', $id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.base-timesheets.edit', $id) }}"><img src="/img/edit_black_18dp.png" alt="Изменить" title="Изменить"></a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#"><img src="/img/delete_black_18dp.png" alt="Удалить" title="Удалить"></button>
                                    </form>
                                    @endif
                                    @if ($access == 1)
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.base-timesheets.show', $id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @php
                            $years = $baseTimesheetRow->year_id;
                            $months = $baseTimesheetRow->month_id;
                            $teams = $baseTimesheetRow->team_id;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                <table class="table table-hover table-bordered">
                    <thead>
                        <th class="align-middle" scope="col">Год</th>
                        <th class="align-middle" scope="col">Месяц</th>
                        <th class="align-middle" scope="col">Бригада</th>
                        <th class="align-middle" scope="col">Почасово</th>
                        <th class="align-middle" scope="col">Сдельно</th>
                        <th class="align-middle" scope="col">Итоговая сумма</th>
                        <th scope="col"> </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    @if ($access == 2)
                                    <form>
                                        <a class="btn btn-outline-primary btn-sm disabled" href=""><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                        <a class="btn btn-outline-primary btn-sm disabled" href=""><img src="/img/edit_black_18dp.png" alt="Изменить" title="Изменить"></a>
                                        <button type="submit" disabled class="btn btn-outline-danger btn-sm" href="#"><img src="/img/delete_black_18dp.png" alt="Удалить" title="Удалить"></button>
                                    </form>
                                    @endif
                                    @if ($access == 1)
                                    <a class="btn btn-outline-primary btn-sm disabled" href=""><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
@endsection