@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\ManningOrders $menu, $title, $manningOrdersList */
    @endphp
    <div id="interface-modul" modul="appointments-show"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row col-md-12" style="margin-bottom: -10px">
                            <div class="mr-auto">
                                <h3>{{ $interface['title'] }}</h3>
                            </div>
                            <div class="ml-auto">
                                @if ($access == 2)
                                <form name="delete" method="POST" action="{{ route('hr.manning-orders.destroy', $manningOrderData->id) }}">
                                    <div class="form-row">
                                        <div class='form-group col-md-auto'>
                                            @method('DELETE')
                                            @csrf
                                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.manning-orders.index') }}"><img src="/img/visibility_off_black_18dp.png" alt="Закрыть" title="Закрыть"></a>
                                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.manning-orders.edit', $manningOrderData->id) }}"><img src="/img/edit_black_18dp.png" alt="Изменить" title="Изменить"></a>
                                            <button type="submit" class="btn btn-outline-danger btn-sm" href="#"><img src="/img/delete_black_18dp.png" alt="Удалить" title="Удалить"></button>
                                        </div>
                                    </div>
                                </form>
                                @endif
                                @if ($access == 1)
                                <div class="form-row">
                                    <div class='form-group col-md-auto'>
                                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.manning-orders.index') }}"><img src="/img/visibility_off_black_18dp.png" alt="Закрыть" title="Закрыть"></a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('hr.manning-orders.includes.result_messages')

                        <form name="show">
                            <div class="row justify-content-center">
                                <div class='media form-group col-md-11'>
                                    <div>
                                        <img src="{{ $personalCardData->photo_url }}" alt="Фото" class="img-thumbnail mr-3" height="180" width="180">
                                    </div>
                                    <div class="media-body">
                                        <div class='form-row'>
                                            <div class="col-md-5">
                                                <label for='leader' class="col-form-label col-form-label-sm">Сотрудник</label>
                                                <input name='leader' value='{{ $userData->name }}' id='leader' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Бригадир'>
                                            </div>
                                            <div class="col-md-3">
                                                <label for='personal_account' class="col-form-label col-form-label-sm">Табельный номер</label>
                                                <input name='personal_account' value='{{ $personalCardData->personal_account }}' id='personal_account' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Табельный номер'>
                                            </div>
                                            <div class='col-md-1'>
                                                <label for='sex' class="col-form-label col-form-label-sm">Пол</label>
                                                <input name='sex' value='{{ $personalCardData->sex }}' id='sex' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Пол'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='born_date' class="col-form-label col-form-label-sm">Дата рождения</label>
                                                <input name='born_date' value='{{ $personalCardData->born_date }}' id='born_date' type='date' maxlength="50" readonly class="form-control form-control-sm" title='Дата рождения'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label for='phone' class="col-form-label col-form-label-sm">Телефон</label>
                                                <input name='phone' value='{{ $personalCardData->phone }}' id='phone' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Телефон'>
                                            </div>
                                            <div class='col-md-6'>
                                                <label for='email' class="col-form-label col-form-label-sm">Email</label>
                                                <input name='email' value='{{ $userData->email }}' id='email' type='email' readonly class="form-control form-control-sm" size="100" title='Email'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class='col-md-3'>
                                                <label for='department' class="col-form-label col-form-label-sm">Департамент</label>
                                                <input name='department' value='{{ $manningOrderData->department }}' id='department' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Департамент'>
                                            </div>
                                            <div class='col-md-6'>
                                                <label for='position' class="col-form-label col-form-label-sm">Должность</label>
                                                <input name='position' value='{{ $manningOrderData->position }}' id='position' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Фактическая должность'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='assignment_date' class="col-form-label col-form-label-sm">Дата назначения</label>
                                                <input name='assignment_date' value='{{ $manningOrderData->assignment_date }}' id='assignment_date' type='date' maxlength="50" readonly class="form-control form-control-sm" title='Дата назначения'>
                                            </div>
                                        </div>
                                        @if ($access == 2)
                                        <div class="form-row">
                                            <div class='col-md-6'>
                                                <label for='profession' class="col-form-label col-form-label-sm">Официальная должность</label>
                                                <input name='profession' value='{{ $manningOrderData->profession }}' id='profession' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Официальная должность'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='profession_code' class="col-form-label col-form-label-sm">Код профессии</label>
                                                <input name='profession_code' value='{{ $manningOrderData->profession_code }}' id='profession_code' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Код профессии'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='resignation_date' class="col-form-label col-form-label-sm">Дата снятия</label>
                                                <input name='resignation_date' value='{{ $manningOrderData->resignation_date }}' id='assignment_date' type='date' maxlength="50" readonly class="form-control form-control-sm" title='Дата снятия'>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                </div>
            </div>
        </div>
    </div>
@endsection