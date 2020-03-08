@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\ManningOrders $menu, $title, $manningOrdersList
         * @var \Illuminate\Database\Eloquent $personalCardsList, $departmentsList, $positionsList, $positionProfessionsList
         */
    @endphp
    <div id="interface-modul" modul="appointments-add"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <form method="POST" action="{{ route('hr.manning-orders.store') }}">
                        @csrf
                        <div class="card-header">
                            <div class="row col-md-12" style="margin-bottom: -10px">
                                <div class="mr-auto">
                                    <h3 id="header">{{ $interface['title'] }}</h3>
                                </div>
                                <div class="ml-auto">
                                    <div class="form-row">
                                        <div class='form-group col-md-auto'>
                                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.manning-orders.index') }}"><img src="/img/visibility_off_black_18dp.png" alt="Закрыть" title="Закрыть"></a>
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
                            @include('hr.manning-orders.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='media form-group col-md-11'>
                                    <div>
                                        <img id='photo_img' src="/img/0.jpg" alt="Фото" class="img-thumbnail mr-3" height="180" width="180">
                                        <br>
                                        <input name='photo_url' value="/img/0.jpg" id='photo_url' type='text' maxlength="255" readonly class="form-control form-control-sm" style="margin-top: 10px; width: 180px;" title='Фото'>
                                    </div>
                                    <div class="media-body">
                                        <div class='form-row'>
                                            <div class='col-md-5'>
                                                <label for='personal_card_id' class="col-form-label col-form-label-sm">Сотрудник</label>
                                                <select name='personal_card_id' id='personal_card_id' type='text' placeholder="Сотрудник" class="form-control form-control-sm" title='Сотрудник' required>
                                                    @foreach($personalCardsList as $personalCardOption)
                                                    <option value="{{ $personalCardOption->id }}" >
                                                        {{ $personalCardOption->personal_card }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for='personal_account' class="col-form-label col-form-label-sm">Табельный номер</label>
                                                <input name='personal_account' value='' id='personal_account' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Табельный номер'>
                                            </div>
                                            <div class='col-md-1'>
                                                <label for='sex' class="col-form-label col-form-label-sm">Пол</label>
                                                <input name='sex' value='' id='sex' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Пол'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='born_date' class="col-form-label col-form-label-sm">Дата рождения</label>
                                                <input name='born_date' value='' id='born_date' type='date' maxlength="50" readonly class="form-control form-control-sm" title='Дата рождения'>
                                            </div>
                                        </div>
                                        <div class='form-row'>
                                            <div class="col-md-4">
                                                <input name='surname' value='' id='surname' type='hidden' maxlength="50" class="form-control form-control-sm" title='Фамилия'>
                                            </div>
                                            <div class="col-md-4">
                                                <input name='first_name' value='' id='first_name' type='hidden' maxlength="50" class="form-control form-control-sm" title='Имя (первое имя)'>
                                            </div>
                                            <div class="col-md-4">
                                                <input name='second_name' value='' id='second_name' type='hidden' maxlength="50" class="form-control form-control-sm" title='Имя (первое имя)'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label for='phone' class="col-form-label col-form-label-sm">Телефон</label>
                                                <input name='phone' value='' id='phone' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Телефон'>
                                            </div>
                                            <div class='col-md-6'>
                                                <label for='email' class="col-form-label col-form-label-sm">Email</label>
                                                <input name='email' value='' id='email' type='email' readonly class="form-control form-control-sm" size="100" title='Email'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class='col-md-3'>
                                                <label for='department_id' class="col-form-label col-form-label-sm">Департамент</label>
                                                <select name='department_id' value='department_id' id='department_id' type='text' placeholder="Департамент" class="form-control form-control-sm" title='Департамент' required>
                                                    @foreach($departmentsList as $departmentsOption)
                                                    <option value="{{ $departmentsOption->id }}" >
                                                        {{ $departmentsOption->department }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class='col-md-6'>
                                                <label for='position_id' class="col-form-label col-form-label-sm">Фактическая должность</label>
                                                <select name='position_id' value='position_id' id='position_id' type='text' placeholder="Фактическая должность" class="form-control form-control-sm" title='Фактическая должность' required>
                                                    @foreach($positionsList as $positionsOption)
                                                    <option value="{{ $positionsOption->id }}" >
                                                        {{ $positionsOption->position }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='assignment_date' class="col-form-label col-form-label-sm">Дата назначения</label>
                                                <input name='assignment_date' id='assignment_date' type='date' maxlength="50" class="form-control form-control-sm" title='Дата назначения'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class='col-md-9'>
                                                <label for='position_profession_id' class="col-form-label col-form-label-sm">Официальная должность</label>
                                                <select name='position_profession_id' value='position_profession_id' id='position_profession_id' type='text' placeholder="Официальная должность" class="form-control form-control-sm" title='Официальная должность' required>
                                                    @foreach($positionProfessionsList as $positionProfessionsOption)
                                                    <option value="{{ $positionProfessionsOption->id }}" >
                                                        {{ $positionProfessionsOption->position_profession }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='resignation_date' class="col-form-label col-form-label-sm">Дата снятия</label>
                                                <input name='resignation_date' id='assignment_date' type='date' maxlength="50" class="form-control form-control-sm" title='Дата снятия'>
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