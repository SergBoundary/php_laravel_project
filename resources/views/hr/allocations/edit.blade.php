@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\Allocations $menu, $title, $allocationsList
         * @var \Illuminate\Database\Eloquent $personalCardsList, $objectsList, $teamsList, $documentsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.allocations.update', $allocationsList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.allocations.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='personal_card_id'>Работник</label>
                                    <div class="input-group mb-3"
>                                        <select name='personal_card_id' value='{{ $allocationsList->personal_cards_id }}' id='personal_card_id' type='text' placeholder="Работник" class="form-control" title='Работник' required>
                                            @foreach($personalCardsList as $personalCardsOption)
                                            <option value="{{ $personal_cardsOption->id }}" 
                                                @if($personalCardsOption->id == $allocationsList->personal_card_id) selected @endif>
                                                {{ $personalCardsOption->personal_card }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('hr.personal-cards.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='object_id'>Определен на объект</label>
                                    <div class="input-group mb-3"
>                                        <select name='object_id' value='{{ $allocationsList->objects_id }}' id='object_id' type='text' placeholder="Определен на объект" class="form-control" title='Определен на объект' required>
                                            @foreach($objectsList as $objectsOption)
                                            <option value="{{ $objectsOption->id }}" 
                                                @if($objectsOption->id == $allocationsList->object_id) selected @endif>
                                                {{ $objectsOption->object }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.objects.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='team_id'>Определен в бригаду</label>
                                    <div class="input-group mb-3"
>                                        <select name='team_id' value='{{ $allocationsList->teams_id }}' id='team_id' type='text' placeholder="Определен в бригаду" class="form-control" title='Определен в бригаду' required>
                                            @foreach($teamsList as $teamsOption)
                                            <option value="{{ $teamsOption->id }}" 
                                                @if($teamsOption->id == $allocationsList->team_id) selected @endif>
                                                {{ $teamsOption->team }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.teams.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='document_id'>Номер документа</label>
                                    <div class="input-group mb-3"
>                                        <select name='document_id' value='{{ $allocationsList->documents_id }}' id='document_id' type='text' placeholder="Номер документа" class="form-control" title='Номер документа' required>
                                            @foreach($documentsList as $documentsOption)
                                            <option value="{{ $documentsOption->id }}" 
                                                @if($documentsOption->id == $allocationsList->document_id) selected @endif>
                                                {{ $documentsOption->document }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('hr.documents.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date'>Дата распределения</label>
                                    <input name='date' value='{{ $allocationsList->date }}' id='date' type='text' maxlength="50" class="form-control" title='Дата распределения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.allocations.show', $allocationsList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.allocations.show', $allocationsList->id) }}">{{ __('Отмена') }}</a>
                                    @endif
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection