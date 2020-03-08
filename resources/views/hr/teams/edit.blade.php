@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\Teams $menu, $title, $teamsList
         * @var \Illuminate\Database\Eloquent $personalCardsList
         */
    @endphp
    <div id="interface-modul" modul="teams-edit"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <form method="POST" action="{{ route('hr.teams.update', $teamData->id) }}">
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
                                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.teams.index') }}"><img src="/img/visibility_off_black_18dp.png" alt="Закрыть" title="Закрыть"></a>
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
                            @include('hr.teams.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='media form-group col-md-11'>
                                    <div>
                                        <img id='photo_img' src="{{ $leaderData->photo_url }}" alt="Фото" class="img-thumbnail mr-3" height="180" width="180">
                                        <br>
                                        <input name='photo_url' value="{{ $leaderData->photo_url }}" id='photo_url' type='text' maxlength="255" readonly class="form-control form-control-sm" style="margin-top: 10px; width: 180px;" title='Фото'>
                                    </div>
                                    <div class="media-body">
                                        <div class='form-row'>
                                            <div class="col-md-6">
                                                <label for='title' class="col-form-label col-form-label-sm">Бригада</label>
                                                <input name='title' value='{{ $teamData->title }}' id='title' type='text' maxlength="50" class="form-control form-control-sm" title='Бригада'>
                                                <input name='abbr' value='{{ $teamData->abbr }}' id='abbr' type='hidden' maxlength="50" class="form-control form-control-sm" title='Бригада'>
                                                <input name='user_id' value='{{ $teamData->user_id }}' id='user_id' type='hidden' maxlength="50" class="form-control form-control-sm" title='Бригада'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='start' class="col-form-label col-form-label-sm">Сформирована</label>
                                                <input name='start' value='{{ $teamData->start }}' id='start' type='date' maxlength="50" class="form-control form-control-sm" title='Сформирована'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='expiry' class="col-form-label col-form-label-sm">Расформирована</label>
                                                <input name='expiry' value='{{ $teamData->expiry }}' id='expiry' type='date' maxlength="50" class="form-control form-control-sm" title='Расформирована'>
                                            </div>
                                        </div>
                                        <div class='form-row'>
                                            <div class='col-md-5'>
                                                <label for='personal_card_id' class="col-form-label col-form-label-sm">Бригадир</label>
                                                <select name='personal_card_id' id='personal_card_id' type='text' class="form-control form-control-sm" title='Бригадир' required>
                                                    @foreach($leadersList as $peopleOption)
                                                    <option value="{{ $peopleOption->id }}" 
                                                        @if($peopleOption->id == $teamData->personal_card_id) selected @endif>
                                                        {{ $peopleOption->personal_card }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for='personal_account' class="col-form-label col-form-label-sm">Табельный номер</label>
                                                <input name='personal_account' value='{{ $leaderData->personal_account }}' id='personal_account' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Табельный номер'>
                                            </div>
                                            <div class='col-md-1'>
                                                <label for='sex' class="col-form-label col-form-label-sm">Пол</label>
                                                <input name='sex' value='{{ $leaderData->sex }}' id='sex' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Пол'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='born_date' class="col-form-label col-form-label-sm">Дата рождения</label>
                                                <input name='born_date' value='{{ $leaderData->born_date }}' id='born_date' type='date' maxlength="50" readonly class="form-control form-control-sm" title='Дата рождения'>
                                            </div>
                                        </div>
                                        <div class='form-row'>
                                            <div class="col-md-4">
                                                <input name='surname' value='{{ $leaderData->surname }}' id='surname' type='hidden' maxlength="50" class="form-control form-control-sm" title='Фамилия'>
                                            </div>
                                            <div class="col-md-4">
                                                <input name='first_name' value='{{ $leaderData->first_name }}' id='first_name' type='hidden' maxlength="50" class="form-control form-control-sm" title='Имя (первое имя)'>
                                            </div>
                                            <div class="col-md-4">
                                                <input name='second_name' value='{{ $leaderData->second_name }}' id='second_name' type='hidden' maxlength="50" class="form-control form-control-sm" title='Имя (первое имя)'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label for='phone' class="col-form-label col-form-label-sm">Телефон</label>
                                                <input name='phone' value='{{ $leaderData->phone }}' id='phone' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Телефон'>
                                            </div>
                                            <div class='col-md-6'>
                                                <label for='email' class="col-form-label col-form-label-sm">Email</label>
                                                <input name='email' value='{{ $userData->email }}' id='email' type='email' readonly class="form-control form-control-sm" size="100" title='Email'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class='col-md-3'>
                                                <label for='department' class="col-form-label col-form-label-sm">Департамент</label>
                                                <input name='department' value='{{ $leaderManningOrderData->department }}' id='department' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Департамент'>
                                            </div>
                                            <div class='col-md-6'>
                                                <label for='position' class="col-form-label col-form-label-sm">Должность</label>
                                                <input name='position' value='{{ $leaderManningOrderData->position }}' id='position' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Фактическая должность'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='assignment_date' class="col-form-label col-form-label-sm">Дата назначения</label>
                                                <input name='assignment_date' value='{{ $leaderManningOrderData->assignment_date }}' id='assignment_date' type='date' maxlength="50" readonly class="form-control form-control-sm" title='Дата назначения'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class='col-md-9'>
                                                <label for='profession' class="col-form-label col-form-label-sm">Официальная должность</label>
                                                <input name='profession' value='{{ $leaderManningOrderData->profession }}' id='profession' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Официальная должность'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='profession_code' class="col-form-label col-form-label-sm">Код профессии</label>
                                                <input name='profession_code' value='{{ $leaderManningOrderData->profession_code }}' id='profession_code' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Код профессии'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                        
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                <div>
                                    <div>
                                        <div class="form-row">
                                            <div class='col-md-12'>
                                                <a class="btn btn-outline-secondary btn-block" data-toggle="collapse" href="#collapseteamObjects" role="button" aria-expanded="false" aria-controls="multiCollapseteamObject">
                                                    @if(!empty($teamData->expiry))
                                                        СПИСОК ПОСЛЕДНИХ ОБЪЕКТОВ В РАБОТЕ <span class="badge badge-secondary">&nbsp;&nbsp;{{ $objectsCount }}&nbsp;&nbsp;</span>
                                                    @else
                                                        СПИСОК ОБЪЕКТОВ В РАБОТЕ <span class="badge badge-secondary">&nbsp;&nbsp;{{ $objectsCount }}&nbsp;&nbsp;</span>
                                                    @endif
                                                </a>
                                                <div class="collapse multi-collapse" id="collapseteamObjects">
                                                @if(count($objectsList) > 0)
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <th class="align-middle" scope="col">Объект</th>
                                                            <th class="align-middle" scope="col">Начало работ</th>
                                                            @if(!empty($teamData->expiry))
                                                                <th class="align-middle" scope="col">Завершение работ</th>
                                                            @endif
                                                        </thead>
                                                        <tbody>
                                                            @foreach($objectsList as $objectRow)
                                                            <tr>
                                                                <td>{{ $objectRow->object }}</td>
                                                                <td>{{ $objectRow->start }}</td>
                                                                @if(!empty($teamData->expiry))
                                                                    <td>{{ $objectRow->expiry }}</td>
                                                                @endif
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <th class="align-middle" scope="col">Объект</th>
                                                            <th class="align-middle" scope="col">Начало работ</th>
                                                            @if(!empty($teamData->expiry))
                                                                <th class="align-middle" scope="col">Завершение работ</th>
                                                            @endif
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Нет данных</td>
                                                                <td>Нет данных</td>
                                                                @if(!empty($teamData->expiry))
                                                                    <td>Нет данных</td>
                                                                @endif
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <div class='col-md-12'>
                                                <a class="btn btn-outline-secondary btn-block" data-toggle="collapse" href="#collapseManningOrders" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                                                    @if(!empty($teamData->expiry))
                                                        ПОСЛЕДНИЙ СОСТАВ БРИГАДЫ <span class="badge badge-secondary">&nbsp;&nbsp;{{ $peopleCount }}&nbsp;&nbsp;</span>
                                                    @else
                                                        ТЕКУЩИЙ СОСТАВ БРИГАДЫ <span class="badge badge-secondary">&nbsp;&nbsp;{{ $peopleCount }}&nbsp;&nbsp;</span>
                                                    @endif
                                                </a>
                                                <div class="collapse multi-collapse" id="collapseManningOrders">
                                                @if(count($peopleList) > 0)
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <th class="align-middle" scope="col">Т/н</th>
                                                            <th class="align-middle" scope="col">Сотрудник</th>
                                                            <th class="align-middle" scope="col">Объект</th>
                                                            <th class="align-middle" scope="col">Прикреплен</th>
                                                            @if(!empty($teamData->expiry))
                                                                <th class="align-middle" scope="col">Откреплен</th>
                                                            @endif
                                                        </thead>
                                                        <tbody>
                                                            @foreach($peopleList as $peopleRow)
                                                            <tr>
                                                                <td>{{ $peopleRow->personal_account }}</td>
                                                                <td>{{ $peopleRow->surname }} {{ $peopleRow->first_name }}</td>
                                                                <td>{{ $peopleRow->object }}</td>
                                                                <td>{{ $peopleRow->start }}</td>
                                                                @if(!empty($teamData->expiry))
                                                                    <td>{{ $peopleRow->expiry }}</td>
                                                                @endif
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <th class="align-middle" scope="col">Т/н</th>
                                                            <th class="align-middle" scope="col">Сотрудник</th>
                                                            <th class="align-middle" scope="col">Объект</th>
                                                            <th class="align-middle" scope="col">Прикреплен</th>
                                                            @if(!empty($teamData->expiry))
                                                                <th class="align-middle" scope="col">Откреплен</th>
                                                            @endif
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Нет данных</td>
                                                                <td>Нет данных</td>
                                                                <td>Нет данных</td>
                                                                <td>Нет данных</td>
                                                                @if(!empty($teamData->expiry))
                                                                    <td>Нет данных</td>
                                                                @endif
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection