@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\EmployeeFamilies $menu, $title, $employeeFamiliesList
         * @var \Illuminate\Database\Eloquent $personalCardsList, $familyRelationTypesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.employee-families.update', $employeeFamiliesList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.employee-families.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='personal_card_id'>Работник</label>
                                    <div class="input-group mb-3"
>                                        <select name='personal_card_id' value='{{ $employeeFamiliesList->personal_cards_id }}' id='personal_card_id' type='text' placeholder="Работник" class="form-control" title='Работник' required>
                                            @foreach($personalCardsList as $personalCardsOption)
                                            <option value="{{ $personal_cardsOption->id }}" 
                                                @if($personalCardsOption->id == $employeeFamiliesList->personal_card_id) selected @endif>
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
                                    <label for='family_relation_type_id'>Степень родства</label>
                                    <div class="input-group mb-3"
>                                        <select name='family_relation_type_id' value='{{ $employeeFamiliesList->family_relation_types_id }}' id='family_relation_type_id' type='text' placeholder="Степень родства" class="form-control" title='Степень родства' required>
                                            @foreach($familyRelationTypesList as $familyRelationTypesOption)
                                            <option value="{{ $family_relation_typesOption->id }}" 
                                                @if($familyRelationTypesOption->id == $employeeFamiliesList->family_relation_type_id) selected @endif>
                                                {{ $familyRelationTypesOption->family_relation_type }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.family-relation-types.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='surname'>Фамилия</label>
                                    <input name='surname' value='{{ $employeeFamiliesList->surname }}' id='surname' type='text' maxlength="50" class="form-control" title='Фамилия'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='first_name'>Имя (первое имя)</label>
                                    <input name='first_name' value='{{ $employeeFamiliesList->first_name }}' id='first_name' type='text' maxlength="50" class="form-control" title='Имя (первое имя)'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='second_name'>Отчество (второе имя)</label>
                                    <input name='second_name' value='{{ $employeeFamiliesList->second_name }}' id='second_name' type='text' maxlength="50" class="form-control" title='Отчество (второе имя)'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='born_date'>Дата рождения</label>
                                    <input name='born_date' value='{{ $employeeFamiliesList->born_date }}' id='born_date' type='text' maxlength="50" class="form-control" title='Дата рождения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='sex'>Пол</label>
                                    <input name='sex' value='{{ $employeeFamiliesList->sex }}' id='sex' type='text' maxlength="50" class="form-control" title='Пол'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.employee-families.show', $employeeFamiliesList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.employee-families.show', $employeeFamiliesList->id) }}">{{ __('Отмена') }}</a>
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