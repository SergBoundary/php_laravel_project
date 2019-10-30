@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\WorkExperiences $menu, $title, $workExperiencesList
         * @var \Illuminate\Database\Eloquent $personalCardsList, $positionProfessionsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.work-experiences.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.work-experiences.includes.result_messages')
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
                                    <label for='work_experience_years'>Количество лет стажа до поступления</label>
                                    <input name='work_experience_years' id='work_experience_years' type='text' maxlength="50" class="form-control" title='Количество лет стажа до поступления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='work_experience_months'>Количество месяцев стажа до поступления</label>
                                    <input name='work_experience_months' id='work_experience_months' type='text' maxlength="50" class="form-control" title='Количество месяцев стажа до поступления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='work_experience_days'>Количество дней стажа до поступления</label>
                                    <input name='work_experience_days' id='work_experience_days' type='text' maxlength="50" class="form-control" title='Количество дней стажа до поступления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='work_experience_continuous'>Количество дней непрерывного стажа</label>
                                    <input name='work_experience_continuous' id='work_experience_continuous' type='text' maxlength="50" class="form-control" title='Количество дней непрерывного стажа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.work-experiences.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.work-experiences.index') }}">{{ __('Отмена') }}</a>
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