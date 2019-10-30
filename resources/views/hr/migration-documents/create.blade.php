@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\MigrationDocuments $menu, $title, $migrationDocumentsList
         * @var \Illuminate\Database\Eloquent $personalCardsList, $migrationStatusesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.migration-documents.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.migration-documents.includes.result_messages')
                            <div class="row justify-content-center">
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
                                    <label for='migration_status_id'>Миграционный статус работника</label>
                                    <div class="input-group mb-3"
>                                        <select name='migration_status_id' value='migration_status_id' id='migration_status_id' type='text' placeholder="Миграционный статус работника" class="form-control" title='Миграционный статус работника' required>
                                            @foreach($migrationStatusesList as $migrationStatusesOption)
                                            <option value="{{ $migration_statusesOption->id }}" >
                                                {{ $migrationStatusesOption->migration_status }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('hr.migration-statuses.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='type'>Вид документа</label>
                                    <input name='type' id='type' type='text' maxlength="50" class="form-control" title='Вид документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='number'>Номер документа</label>
                                    <input name='number' id='number' type='text' maxlength="50" class="form-control" title='Номер документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_issued'>Дата выдачи документа</label>
                                    <input name='date_issued' id='date_issued' type='text' maxlength="50" class="form-control" title='Дата выдачи документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_expiration'>Дата окончания действия документа</label>
                                    <input name='date_expiration' id='date_expiration' type='text' maxlength="50" class="form-control" title='Дата окончания действия документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_inclusion'>Дата включения документа в пакет</label>
                                    <input name='date_inclusion' id='date_inclusion' type='text' maxlength="50" class="form-control" title='Дата включения документа в пакет'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_seizure'>Дата изъятия документа из пакета</label>
                                    <input name='date_seizure' id='date_seizure' type='text' maxlength="50" class="form-control" title='Дата изъятия документа из пакета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.migration-documents.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.migration-documents.index') }}">{{ __('Отмена') }}</a>
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