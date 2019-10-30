@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\LastJobs $menu, $title, $lastJobsList
         * @var \Illuminate\Database\Eloquent $personalCardsList, $positionProfessionsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.last-jobs.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.last-jobs.includes.result_messages')
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
                                    <label for='position_profession_id'>Основная профессия</label>
                                    <div class="input-group mb-3"
>                                        <select name='position_profession_id' value='position_profession_id' id='position_profession_id' type='text' placeholder="Основная профессия" class="form-control" title='Основная профессия' required>
                                            @foreach($positionProfessionsList as $positionProfessionsOption)
                                            <option value="{{ $position_professionsOption->id }}" >
                                                {{ $positionProfessionsOption->position_profession }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.position-professions.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='last_job'>Последнее место работы</label>
                                    <input name='last_job' id='last_job' type='text' maxlength="50" class="form-control" title='Последнее место работы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='dismissal_date'>Дата увольнения</label>
                                    <input name='dismissal_date' id='dismissal_date' type='text' maxlength="50" class="form-control" title='Дата увольнения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='dismissal_reason'>Причина увольнения</label>
                                    <input name='dismissal_reason' id='dismissal_reason' type='text' maxlength="50" class="form-control" title='Причина увольнения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.last-jobs.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.last-jobs.index') }}">{{ __('Отмена') }}</a>
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