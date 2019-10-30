@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\CalculationGroups $menu, $title, $calculationGroupsList */
        $accrualGroups = "";
        $accruals = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($calculationGroupsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="3">Признак использования</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.calculation-groups.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($calculationGroupsList as $calculationGroupsRow)
                        @if ($accrualGroups != $calculationGroupsRow->accrual_groups)
                        <tr>
                            <td colspan="4" class="text-muted text-uppercase"><em> {{ $calculationGroupsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($accruals != $calculationGroupsRow->accrual)
                        <tr>
                            <td colspan="4" class="text-muted text-uppercase"><em>  {{ $calculationGroupsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td>{{ $calculationGroupsRow->calculation_attribute }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.calculation-groups.destroy', $calculationGroupsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.calculation-groups.show', $calculationGroupsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.calculation-groups.edit', $calculationGroupsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $accrualGroups = $calculationGroupsRow->accrual_groups;
                            $accruals = $calculationGroupsRow->accrual;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.calculation-groups.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection