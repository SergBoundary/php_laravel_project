@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\PersonalCommunications $menu, $title, $personalCommunicationsList */
        $personalCards = "";
        $communicationTypes = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($personalCommunicationsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="3">Телефон, мейл</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-communications.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($personalCommunicationsList as $personalCommunicationsRow)
                        @if ($personalCards != $personalCommunicationsRow->personal_card)
                        <tr>
                            <td colspan="4" class="text-muted text-uppercase"><em> {{ $personalCommunicationsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($communicationTypes != $personalCommunicationsRow->communication_type)
                        <tr>
                            <td colspan="4" class="text-muted text-uppercase"><em>  {{ $personalCommunicationsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td>{{ $personalCommunicationsRow->content }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.personal-communications.destroy', $personalCommunicationsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.personal-communications.show', $personalCommunicationsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.personal-communications.edit', $personalCommunicationsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $personalCommunicationsRow->personal_card;
                            $communicationTypes = $personalCommunicationsRow->communication_type;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-communications.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection