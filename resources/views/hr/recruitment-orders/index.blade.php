@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\RecruitmentOrders $menu, $title, $recruitmentOrdersList */
        $documents = "";
        $personalCards = "";
        $dismissalReasons = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($recruitmentOrdersList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="4">Дата найма</th>
                        <th class="align-middle" scope="col">Номер приказа о найме</th>
                        <th class="align-middle" scope="col">Дата увольнения</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.recruitment-orders.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($recruitmentOrdersList as $recruitmentOrdersRow)
                        @if ($documents != $recruitmentOrdersRow->document)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em> {{ $recruitmentOrdersRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($personalCards != $recruitmentOrdersRow->personal_card)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>  {{ $recruitmentOrdersRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($dismissalReasons != $recruitmentOrdersRow->dismissal_reason)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>   {{ $recruitmentOrdersRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $recruitmentOrdersRow->employment_date }}</td>
                            <td>{{ $recruitmentOrdersRow->employment_order }}</td>
                            <td>{{ $recruitmentOrdersRow->dismissal_date }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.recruitment-orders.destroy', $recruitmentOrdersRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.recruitment-orders.show', $recruitmentOrdersRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.recruitment-orders.edit', $recruitmentOrdersRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $documents = $recruitmentOrdersRow->document;
                            $personalCards = $recruitmentOrdersRow->personal_card;
                            $dismissalReasons = $recruitmentOrdersRow->dismissal_reason;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.recruitment-orders.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection