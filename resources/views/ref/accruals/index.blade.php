@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\Accruals $menu, $title, $accrualsList */
        $accrualGroups = "";
        $algorithms = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($accrualsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="3">Код начисления/удержания</th>
                        <th class="align-middle" scope="col">Направление операции</th>
                        <th class="align-middle" scope="col">Сокращенное наименование начисления/удержания</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.accruals.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($accrualsList as $accrualsRow)
                        @if ($accrualGroups != $accrualsRow->accrual_group)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em> {{ $accrualsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($algorithms != $accrualsRow->algorithm)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>  {{ $accrualsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td>{{ $accrualsRow->title }}</td>
                            <td>{{ $accrualsRow->direction }}</td>
                            <td>{{ $accrualsRow->description_abbr }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.accruals.destroy', $accrualsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.accruals.show', $accrualsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.accruals.edit', $accrualsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $accrualGroups = $accrualsRow->accrual_group;
                            $algorithms = $accrualsRow->algorithm;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.accruals.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection