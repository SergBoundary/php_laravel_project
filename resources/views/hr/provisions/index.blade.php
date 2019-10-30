@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\Provisions $menu, $title, $provisionsList */
        $documents = "";
        $manningOrders = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($provisionsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="3">Сумма/стоимость средств</th>
                        <th class="align-middle" scope="col">Дата выдачи</th>
                        <th class="align-middle" scope="col">Дата возврата</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.provisions.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($provisionsList as $provisionsRow)
                        @if ($documents != $provisionsRow->document)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em> {{ $provisionsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($manningOrders != $provisionsRow->manning_orders)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>  {{ $provisionsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td>{{ $provisionsRow->amount }}</td>
                            <td>{{ $provisionsRow->provision_date }}</td>
                            <td>{{ $provisionsRow->return_date }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.provisions.destroy', $provisionsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.provisions.show', $provisionsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.provisions.edit', $provisionsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $documents = $provisionsRow->document;
                            $manningOrders = $provisionsRow->manning_orders;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.provisions.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection