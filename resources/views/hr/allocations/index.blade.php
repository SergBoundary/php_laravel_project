@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\Allocations $menu, $title, $allocationsList */
        $personalCards = "";
        $objects = "";
        $teams = "";
        $documents = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($allocationsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="5">Дата распределения</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.allocations.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($allocationsList as $allocationsRow)
                        @if ($personalCards != $allocationsRow->personal_card)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em> {{ $allocationsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($objects != $allocationsRow->object)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>  {{ $allocationsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($teams != $allocationsRow->team)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>   {{ $allocationsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($documents != $allocationsRow->document)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>    {{ $allocationsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $allocationsRow->date }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.allocations.destroy', $allocationsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.allocations.show', $allocationsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.allocations.edit', $allocationsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $allocationsRow->personal_card;
                            $objects = $allocationsRow->object;
                            $teams = $allocationsRow->team;
                            $documents = $allocationsRow->document;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.allocations.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection