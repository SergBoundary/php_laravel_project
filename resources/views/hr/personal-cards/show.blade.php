@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\PersonalCards 
         $user, $personalCardData, $manningOrderData, $allocationData, 
         $manningOrderList, $allocationList, 
         $manningOrderCount, $allocationCount
         */
    @endphp
    <div id="interface-modul" modul="human-resources-show"></div>
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
                                <form name="delete" method="POST" action="{{ route('hr.personal-cards.destroy', $personalCardData->id) }}">
                                    <div class="form-row">
                                        <div class='form-group col-md-auto'>
                                            @method('DELETE')
                                            @csrf
                                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-cards.index') }}"><img src="/img/visibility_off_black_18dp.png" alt="Закрыть" title="Закрыть"></a>
                                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-cards.edit', $personalCardData->id) }}"><img src="/img/edit_black_18dp.png" alt="Изменить" title="Изменить"></a>
                                            <button type="submit" class="btn btn-outline-danger btn-sm" href="#"><img src="/img/delete_black_18dp.png" alt="Удалить" title="Удалить"></button>
                                        </div>
                                    </div>
                                </form>
                                @endif
                                @if ($access == 1)
                                <div class="form-row">
                                    <div class='form-group col-md-auto'>
                                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-cards.index') }}"><img src="/img/visibility_off_black_18dp.png" alt="Закрыть" title="Закрыть"></a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('hr.personal-cards.includes.result_messages')

                        <form name="show">
                            <div class="row justify-content-center">
                                <div class='media form-group col-md-11'>
                                    <div>
                                        <img src="{{ $personalCardData->photo_url }}" alt="Фото" class="img-thumbnail mr-3" height="180" width="180">
                                    </div>
                                    <div class="media-body">
                                        <div class='form-row'>
                                            <div class="col-md-4">
                                                <label for='surname' class="col-form-label col-form-label-sm">Фамилия</label>
                                                <input name='surname' value='{{ $personalCardData->surname }}' id='surname' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Фамилия'>
                                            </div>
                                            <div class="col-md-4">
                                                <label for='first_name' class="col-form-label col-form-label-sm">Имя</label>
                                                <input name='first_name' value='{{ $personalCardData->first_name }}' id='first_name' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Имя (первое имя)'>
                                            </div>
                                            <div class="col-md-4">
                                                <label for='second_name' class="col-form-label col-form-label-sm">Отчество</label>
                                                <input name='second_name' value='{{ $personalCardData->second_name }}' id='second_name' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Имя (первое имя)'>
                                            </div>
                                        </div>
                                        <div class='form-row'>
                                            <div class="col-md-3">
                                                <label for='personal_account' class="col-form-label col-form-label-sm">Табельный номер</label>
                                                <input name='personal_account' value='{{ $personalCardData->personal_account }}' id='personal_account' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Табельный номер'>
                                            </div>
                                            <div class="col-md-5">
                                                <label for='full_name_latina' class="col-form-label col-form-label-sm">Фамилия и имя латиницей</label>
                                                <input name='full_name_latina' value='{{ $personalCardData->full_name_latina }}' id='full_name_latina' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Фамилия и имя латиницей'>
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
                                            @if(count($manningOrderList) > 0)
                                            <div class='col-md-3'>
                                                <label for='department' class="col-form-label col-form-label-sm">Департамент</label>
                                                <input name='department' value='{{ $manningOrderData->department }}' id='department' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Департамент'>
                                            </div>
                                            <div class='col-md-6'>
                                                <label for='position' class="col-form-label col-form-label-sm">Фактическая должность</label>
                                                <input name='position' value='{{ $manningOrderData->position }}' id='position' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Фактическая должность'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='assignment_date' class="col-form-label col-form-label-sm">Дата назначения</label>
                                                <input name='assignment_date' value='{{ $manningOrderData->assignment_date }}' id='assignment_date' type='date' maxlength="50" readonly class="form-control form-control-sm" title='Дата назначения'>
                                            </div>
                                            @else
                                            <div class='col-md-3'>
                                                <label for='department' class="col-form-label col-form-label-sm">Департамент</label>
                                                <input name='department' value='' id='department' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Департамент'>
                                            </div>
                                            <div class='col-md-6'>
                                                <label for='position' class="col-form-label col-form-label-sm">Фактическая должность</label>
                                                <input name='position' value='' id='position' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Фактическая должность'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='assignment_date' class="col-form-label col-form-label-sm">Дата назначения</label>
                                                <input name='assignment_date' value='' id='assignment_date' type='date' maxlength="50" readonly class="form-control form-control-sm" title='Дата назначения'>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-row">
                                            @if(count($manningOrderList) > 0)
                                            <div class='col-md-9'>
                                                <label for='profession' class="col-form-label col-form-label-sm">Официальная должность</label>
                                                <input name='profession' value='{{ $manningOrderData->profession }}' id='profession' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Официальная должность'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='profession_code' class="col-form-label col-form-label-sm">Код профессии</label>
                                                <input name='profession_code' value='{{ $manningOrderData->profession_code }}' id='profession_code' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Код профессии'>
                                            </div>
                                            @else
                                            <div class='col-md-9'>
                                                <label for='profession' class="col-form-label col-form-label-sm">Официальная должность</label>
                                                <input name='profession' value='' id='profession' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Официальная должность'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='profession_code' class="col-form-label col-form-label-sm">Код профессии</label>
                                                <input name='profession_code' value='' id='profession_code' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Код профессии'>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-row">
                                            @if(count($allocationList) > 0)
                                            <div class='col-md-3'>
                                                <label for='team' class="col-form-label col-form-label-sm">Бригада</label>
                                                <input name='team' value='{{ $allocationData->team }}' id='team' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Бригада'>
                                            </div>
                                            <div class='col-md-6'>
                                                <label for='object' class="col-form-label col-form-label-sm">Объект</label>
                                                <input name='object' value='{{ $allocationData->object }}' id='object' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Объект'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='start' class="col-form-label col-form-label-sm">Дата перемещения</label>
                                                <input name='start' value='{{ $allocationData->start }}' id='start' type='date' maxlength="50" readonly class="form-control form-control-sm" title='Дата перемещения'>
                                            </div>
                                            @else
                                            <div class='col-md-3'>
                                                <label for='team' class="col-form-label col-form-label-sm">Бригада</label>
                                                <input name='team' value='' id='team' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Бригада'>
                                            </div>
                                            <div class='col-md-6'>
                                                <label for='object' class="col-form-label col-form-label-sm">Объект</label>
                                                <input name='object' value='' id='object' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Объект'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='start' class="col-form-label col-form-label-sm">Дата перемещения</label>
                                                <input name='start' value='' id='start' type='date' maxlength="50" readonly class="form-control form-control-sm" title='Дата перемещения'>
                                            </div>
                                            @endif
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
                                                <a class="btn btn-outline-secondary btn-block" data-toggle="collapse" href="#collapseManningOrders" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                                                    ИСТОРИЯ НАЗНАЧЕНИЙ <span class="badge badge-secondary">&nbsp;&nbsp;{{ $manningOrderCount }}&nbsp;&nbsp;</span>
                                                </a>
                                                <div class="collapse multi-collapse" id="collapseManningOrders">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <th class="align-middle" scope="col">Департамент</th>
                                                            <th class="align-middle" scope="col">Должность</th>
                                                            <th class="align-middle" scope="col">Формальная должность</th>
                                                            <th class="align-middle" scope="col">Код</th>
                                                            <th class="align-middle" scope="col">Назначен</th>
                                                            <th class="align-middle" scope="col">Снят</th>
                                                        </thead>
                                                        <tbody>
                                                        @if(count($manningOrderList) > 0)
                                                            @foreach($manningOrderList as $manningOrderRow)
                                                            <tr>
                                                                <td>{{ $manningOrderRow->department }}</td>
                                                                <td>{{ $manningOrderRow->position }}</td>
                                                                <td>{{ $manningOrderRow->profession_code }}</td>
                                                                <td>{{ $manningOrderRow->assignment_date }}</td>
                                                                <td>{{ $manningOrderRow->resignation_date }}</td>
                                                            </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td>...</td>
                                                                <td>...</td>
                                                                <td>...</td>
                                                                <td>...</td>
                                                                <td>...</td>
                                                            </tr>
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <div class='col-md-12'>
                                                <a class="btn btn-outline-secondary btn-block" data-toggle="collapse" href="#collapseAllocations" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                                                    ИСТОРИЯ ПЕРЕМЕЩЕНИЙ <span class="badge badge-secondary">&nbsp;&nbsp;{{ $allocationCount }}&nbsp;&nbsp;</span>
                                                </a>
                                                <div class="collapse multi-collapse" id="collapseAllocations">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <th class="align-middle" scope="col">Объект</th>
                                                            <th class="align-middle" scope="col">Бригада</th>
                                                            <th class="align-middle" scope="col">Прикреплен</th>
                                                            <th class="align-middle" scope="col">Откреплен</th>
                                                        </thead>
                                                        <tbody>
                                                        @if(count($allocationList) > 0)
                                                            @foreach($allocationList as $allocationRow)
                                                            <tr>
                                                                <td>{{ $allocationRow->object }}</td>
                                                                <td>{{ $allocationRow->team }}</td>
                                                                <td>{{ $allocationRow->start }}</td>
                                                                <td>{{ $allocationRow->expiry }}</td>
                                                            </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td>...</td>
                                                                <td>...</td>
                                                                <td>...</td>
                                                                <td>...</td>
                                                            </tr>
                                                        @endif
                                                        </tbody>
                                                    </table>
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
    </div>
@endsection