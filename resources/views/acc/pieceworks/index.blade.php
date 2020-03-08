@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\Pieceworks $menu, $title, $pieceworksList */
        $years = "";
        $months = "";
        $teams = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            @include('acc.pieceworks.includes.result_messages')
            <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="mr-auto">
                            <h2><small class="text-muted text-uppercase">{{ $title }}</small></h2><br />
                        </div>
                        @if ($access == 2)
                        <form method="POST" action="{{ route('acc.pieceworks.create') }}">
                        @method('GET')
                        @csrf
                        <div class="form-row ml-auto" style="margin-right: 30px">
                            <div class='col-md-6'>
                                <select name='month_id' id='month_id' type='text' class="form-control form-control-sm" title='Месяц' required>
                                    @foreach($monthsList as $monthOption)
                                    <option value="{{ $monthOption->id }}" 
                                        @if($monthOption->id == $month->id) selected @endif>
                                        {{ $monthOption->month }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class='col-md-5'>
                                <select name='year_id' id='year_id' type='text' class="form-control form-control-sm" title='Месяц' required>
                                    @foreach($yearsList as $yearOption)
                                    <option value="{{ $yearOption->id }}" 
                                        @if($yearOption->id == $year->id) selected @endif>
                                        {{ $yearOption->year }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class='col-md-1'>
                                <button type="submit" class="btn btn-outline-secondary btn-sm" href="#"><img src="/img/add_black_18dp.png" alt="Добавить" title="Добавить"></button>
                            </div>
                        </div>
                        </form>
                        @endif
                    </div>
                </div>
               @if(count($pieceworksList) > 0)
                <table class="table table-hover table-bordered">
                    <thead>
                        <th class="align-middle" scope="col">Год</th>
                        <th class="align-middle" scope="col">Месяц</th>
                        <th class="align-middle" scope="col">Бригада</th>
                        <th class="align-middle" scope="col">Количество работников</th>
                        <th class="align-middle" scope="col">Итоговая сумма</th>
                        <th scope="col">
                        </th>
                    </thead>
                    <tbody>
                        @foreach($pieceworksList as $pieceworksRow)
                        @php
                            $id = $pieceworksRow->team_id."-".$pieceworksRow->year_id."-".$pieceworksRow->month_id
                        @endphp
                        <tr>
                            @if ($years == $pieceworksRow->year_id 
                            && $months == $pieceworksRow->month_id)
                            <td colspan="2"> </td>
                            @elseif ($years == $pieceworksRow->year_id)
                            <td> </td>
                            <td>{{ $pieceworksRow->month }}</td>
                            @else
                            <td>{{ $pieceworksRow->year }}</td>
                            <td>{{ $pieceworksRow->month }}</td>
                            @endif
                            <td>{{ $pieceworksRow->team }}</td>
                            <td>{{ $pieceworksRow->count }}</td>
                            <td>{{ $pieceworksRow->total }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    @if ($access == 2)
                                    <form method="POST" action="{{ route('acc.pieceworks.destroy', $id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.pieceworks.show', $id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.pieceworks.edit', $id) }}"><img src="/img/edit_black_18dp.png" alt="Изменить" title="Изменить"></a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#"><img src="/img/delete_black_18dp.png" alt="Удалить" title="Удалить"></button>
                                    </form>
                                    @endif
                                    @if ($access == 1)
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.pieceworks.show', $id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @php
                            $years = $pieceworksRow->year_id;
                            $months = $pieceworksRow->month_id;
                            $teams = $pieceworksRow->team_id;
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
                        <th class="align-middle" scope="col">Количество работников</th>
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