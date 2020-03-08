@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\PersonalCards 
         $user, $personalCardData, $manningOrderData, $allocationData, 
         $manningOrderList, $allocationList, 
         $manningOrderCount, $allocationCount
         */
    @endphp
    <div id="interface-modul" modul="human-resources-edit"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <form method="POST" action="{{ route('hr.personal-cards.update', $personalCardData->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="card-header">
                            <div class="row col-md-12" style="margin-bottom: -10px">
                                <div class="mr-auto">
                                    <h3>{{ $interface['title'] }}</h3>
                                </div>
                                <div class="ml-auto">
                                    <div class="form-row">
                                        <div class='form-group col-md-auto'>
                                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-cards.index') }}"><img src="/img/visibility_off_black_18dp.png" alt="Закрыть" title="Закрыть"></a>
                                            <button type="submit" class="btn btn-outline-success btn-sm">
                                                <img src="/img/save_black_18dp.png" alt="Сохранить" title="Сохранить">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.personal-cards.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='media form-group col-md-11'>
                                    <div>
                                        <img src="{{ $personalCardData->photo_url }}" alt="Фото" class="img-thumbnail mr-3" height="180" width="180">
                                        <br>
                                        <input name='photo_url' value="{{ $personalCardData->photo_url }}" id='photo_url' type='text' maxlength="255" readonly class="form-control form-control-sm" style="margin-top: 10px; width: 180px;" title='Фото'>
                                    </div>
                                    <div class="media-body">
                                        <div class='form-row'>
                                            <div class="col-md-4">
                                                <label for='surname' class="col-form-label col-form-label-sm">Фамилия</label>
                                                <input name='surname' value="{{ $personalCardData->surname }}" id='surname' type='text' maxlength="50" class="form-control form-control-sm" title='Фамилия'>
                                                <input name='user_id' value='{{ $personalCardData->user_id }}' id='user_id' type='hidden' maxlength="50" class="form-control form-control-sm" title='Бригада'>
                                            </div>
                                            <div class="col-md-4">
                                                <label for='first_name' class="col-form-label col-form-label-sm">Имя</label>
                                                <input name='first_name' value="{{ $personalCardData->first_name }}" id='first_name' type='text' maxlength="50" class="form-control form-control-sm" title='Имя (первое имя)'>
                                            </div>
                                            <div class="col-md-4">
                                                <label for='second_name' class="col-form-label col-form-label-sm">Отчество</label>
                                                <input name='second_name' value="{{ $personalCardData->second_name }}" id='second_name' type='text' maxlength="50" class="form-control form-control-sm" title='Имя (первое имя)'>
                                            </div>
                                        </div>
                                        <div class='form-row'>
                                            <div class="col-md-3">
                                                <label for='personal_account' class="col-form-label col-form-label-sm">Табельный номер</label>
                                                <input name='personal_account' value="{{ $personalCardData->personal_account }}" id='personal_account' type='text' maxlength="50" class="form-control form-control-sm" title='Табельный номер'>
                                            </div>
                                            <div class="col-md-5">
                                                <label for='full_name_latina' class="col-form-label col-form-label-sm">Фамилия и имя латиницей</label>
                                                <input name='full_name_latina' value='{{ $personalCardData->full_name_latina }}' id='full_name_latina' type='text' maxlength="50" class="form-control form-control-sm" title='Фамилия и имя латиницей'>
                                            </div>
                                            <div class='col-md-1'>
                                                <label for='sex' class="col-form-label col-form-label-sm">Пол</label>
                                                <input name='sex' value='{{ $personalCardData->sex }}' id='sex' type='text' maxlength="50" class="form-control form-control-sm" title='Пол'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='born_date' class="col-form-label col-form-label-sm">Дата рождения</label>
                                                <input name='born_date' value='{{ $personalCardData->born_date }}' id='born_date' type='date' maxlength="50" class="form-control form-control-sm" title='Дата рождения'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label for='phone' class="col-form-label col-form-label-sm">Телефон</label>
                                                <input name='phone' value='{{ $personalCardData->phone }}' id='phone' type='text' maxlength="50" class="form-control form-control-sm" title='Телефон'>
                                            </div>
                                            <div class='col-md-6'>
                                                <label for='email' class="col-form-label col-form-label-sm">Email</label>
                                                <input name='email' value='{{ $userData->email }}' id='email' type='email' class="form-control form-control-sm" size="100" title='Email'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class='col-md-3'>
                                                <label for='department_id' class="col-form-label col-form-label-sm">Департамент</label>
                                                <select name='department_id' value='department_id' id='department_id' type='text' placeholder="Департамент" class="form-control form-control-sm" title='Департамент' required>
                                                    @foreach($departmentsList as $departmentsOption)
                                                    <option value="{{ $departmentsOption->id }}" 
                                                        @if($departmentsOption->id == $manningOrderData->department_id) selected @endif>
                                                        {{ $departmentsOption->department }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class='col-md-6'>
                                                <label for='position_id' class="col-form-label col-form-label-sm">Фактическая должность</label>
                                                <select name='position_id' value='position_id' id='position_id' type='text' placeholder="Фактическая должность" class="form-control form-control-sm" title='Фактическая должность' required>
                                                    @foreach($positionsList as $positionsOption)
                                                    <option value="{{ $positionsOption->id }}" 
                                                        @if($positionsOption->id == $manningOrderData->position_id) selected @endif>
                                                        {{ $positionsOption->position }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='assignment_date' class="col-form-label col-form-label-sm">Дата назначения</label>
                                                <input name='assignment_date'  value='{{ $manningOrderData->assignment_date }}' id='assignment_date' type='date' maxlength="50" class="form-control form-control-sm" title='Дата назначения'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class='col-md-12'>
                                                <label for='position_profession_id' class="col-form-label col-form-label-sm">Официальная должность</label>
                                                <select name='position_profession_id' value='position_profession_id' id='position_profession_id' type='text' placeholder="Официальная должность" class="form-control form-control-sm" title='Официальная должность' required>
                                                    @foreach($positionProfessionsList as $positionProfessionsOption)
                                                    <option value="{{ $positionProfessionsOption->id }}" 
                                                        @if($positionProfessionsOption->id == $manningOrderData->position_profession_id) selected @endif>
                                                        {{ $positionProfessionsOption->position_profession }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class='col-md-6'>
                                                <label for='team_id' class="col-form-label col-form-label-sm">Бригада</label>
                                                <select name='team_id' value='team_id' id='team_id' type='text' placeholder="Бригада" class="form-control form-control-sm" title='Бригада' required>
                                                    @foreach($teamsList as $teamsOption)
                                                    <option value="{{ $teamsOption->id }}" 
                                                        @if($teamsOption->id == $allocationData->team_id) selected @endif>
                                                        {{ $teamsOption->team }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='start' class="col-form-label col-form-label-sm">Дата прикрепления</label>
                                                <input name='start'   value='{{ $allocationData->start }}' id='start' type='date' maxlength="50" class="form-control form-control-sm" title='Дата прикрепления'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='expiry' class="col-form-label col-form-label-sm">Дата открепления</label>
                                                <input name='expiry'   value='{{ $allocationData->expiry }}' id='expiry' type='date' maxlength="50" class="form-control form-control-sm" title='Дата открепления'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class='col-md-12'>
                                                <label for='object_id' class="col-form-label col-form-label-sm">Объект</label>
                                                <select name='object_id' value='object_id' id='object_id' type='text' placeholder="Объект" class="form-control form-control-sm" title='Объект' required>
                                                    @foreach($objectsList as $objectsOption)
                                                    <option value="{{ $objectsOption->id }}" 
                                                        @if($objectsOption->id == $allocationData->object_id) selected @endif>
                                                        {{ $objectsOption->object }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
@endsection