@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\Documents $menu, $title, $documentsList
         * @var \Illuminate\Database\Eloquent $documentsList, $documentTypesList, $personalCardsList, $usersList, $usersList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.documents.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.documents.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='document_id'>Номер связанного документа</label>
                                    <div class="input-group mb-3"
>                                        <select name='document_id' value='document_id' id='document_id' type='text' placeholder="Номер связанного документа" class="form-control" title='Номер связанного документа' required>
                                            @foreach($documentsList as $documentsOption)
                                            <option value="{{ $documentsOption->id }}" >
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
                                    <label for='document_type_id'>Тип документа</label>
                                    <div class="input-group mb-3"
>                                        <select name='document_type_id' value='document_type_id' id='document_type_id' type='text' placeholder="Тип документа" class="form-control" title='Тип документа' required>
                                            @foreach($documentTypesList as $documentTypesOption)
                                            <option value="{{ $document_typesOption->id }}" >
                                                {{ $documentTypesOption->document_type }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.document-types.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='personal_card_id'>Работник</label>
                                    <div class="input-group mb-3"
>                                        <select name='personal_card_id' value='personal_card_id' id='personal_card_id' type='text' placeholder="Работник" class="form-control" title='Работник' required>
                                            @foreach($personalCardsList as $personalCardsOption)
                                            <option value="{{ $personal_cardsOption->id }}" >
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
                                    <label for='create_user_id'>Автор документа</label>
                                    <div class="input-group mb-3"
>                                        <select name='create_user_id' value='create_user_id' id='create_user_id' type='text' placeholder="Автор документа" class="form-control" title='Автор документа' required>
                                            @foreach($usersList as $usersOption)
                                            <option value="{{ $usersOption->id }}" >
                                                {{ $usersOption->create_user }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('hr.users.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='editor_user_id'>Автор изменения документа</label>
                                    <div class="input-group mb-3"
>                                        <select name='editor_user_id' value='editor_user_id' id='editor_user_id' type='text' placeholder="Автор изменения документа" class="form-control" title='Автор изменения документа' required>
                                            @foreach($usersList as $usersOption)
                                            <option value="{{ $usersOption->id }}" >
                                                {{ $usersOption->editor_user }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('hr.users.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='number'>Номер документа</label>
                                    <input name='number' id='number' type='text' maxlength="50" class="form-control" title='Номер документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date'>Дата выписки документа</label>
                                    <input name='date' id='date' type='text' maxlength="50" class="form-control" title='Дата выписки документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='annotation'>Аннотация к документу</label>
                                    <input name='annotation' id='annotation' type='text' maxlength="50" class="form-control" title='Аннотация к документу'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='description'>Описание документа</label>
                                    <input name='description' id='description' type='text' maxlength="50" class="form-control" title='Описание документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='print'>Статус печати документа</label>
                                    <input name='print' id='print' type='text' maxlength="50" class="form-control" title='Статус печати документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.documents.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.documents.index') }}">{{ __('Отмена') }}</a>
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