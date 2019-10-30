@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\PersonalPasports $menu, $title, $personalPasportsList
         * @var \Illuminate\Database\Eloquent $personalCardsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.personal-pasports.update', $personalPasportsList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.personal-pasports.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='personal_card_id'>Работник</label>
                                    <div class="input-group mb-3"
>                                        <select name='personal_card_id' value='{{ $personalPasportsList->personal_cards_id }}' id='personal_card_id' type='text' placeholder="Работник" class="form-control" title='Работник' required>
                                            @foreach($personalCardsList as $personalCardsOption)
                                            <option value="{{ $personal_cardsOption->id }}" 
                                                @if($personalCardsOption->id == $personalPasportsList->personal_card_id) selected @endif>
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
                                    <label for='series'>Серия паспорта</label>
                                    <input name='series' value='{{ $personalPasportsList->series }}' id='series' type='text' maxlength="50" class="form-control" title='Серия паспорта'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='number'>Номер паспорта</label>
                                    <input name='number' value='{{ $personalPasportsList->number }}' id='number' type='text' maxlength="50" class="form-control" title='Номер паспорта'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='issuing_date'>Дата выдачи</label>
                                    <input name='issuing_date' value='{{ $personalPasportsList->issuing_date }}' id='issuing_date' type='text' maxlength="50" class="form-control" title='Дата выдачи'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='issuing_authority'>Орган выдачи</label>
                                    <input name='issuing_authority' value='{{ $personalPasportsList->issuing_authority }}' id='issuing_authority' type='text' maxlength="50" class="form-control" title='Орган выдачи'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='expiration date'>Утратит силу</label>
                                    <input name='expiration date' value='{{ $personalPasportsList->expiration date }}' id='expiration date' type='text' maxlength="50" class="form-control" title='Утратит силу'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.personal-pasports.show', $personalPasportsList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.personal-pasports.show', $personalPasportsList->id) }}">{{ __('Отмена') }}</a>
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