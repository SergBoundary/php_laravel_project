@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\AccrualRelations $menu, $title, $accrualRelationsList */
        $accruals = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($accrualRelationsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="2">Признак зависимости</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.accrual-relations.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($accrualRelationsList as $accrualRelationsRow)
                        @if ($accruals != $accrualRelationsRow->accrual)
                        <tr>
                            <td colspan="3" class="text-muted text-uppercase"><em> {{ $accrualRelationsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td>{{ $accrualRelationsRow->relation_attribute }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.accrual-relations.destroy', $accrualRelationsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.accrual-relations.show', $accrualRelationsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.accrual-relations.edit', $accrualRelationsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $accruals = $accrualRelationsRow->accrual;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.accrual-relations.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection