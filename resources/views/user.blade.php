@extends('layouts.app')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\PersonalCards 
         $user, $personalCardsData, $manningOrderData, $allocationData, 
         $manningOrderList, $allocationList, 
         $manningOrderCount, $allocationCount
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row col-md-12" style="margin-bottom: -10px">
                            <div class="mr-auto">
                                <h3>{{ $title }}</h3>
                            </div>
                            <div class="ml-auto">
                                <div class="form-row">
                                    <div class='form-group col-md-auto'>
                                        <a class="btn btn-outline-secondary btn-sm" href="{{ url('/') }}"><img src="/img/visibility_off_black_18dp.png" alt="Закрыть" title="Закрыть"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <form>
                            <div class="row justify-content-center">
                                <div class='media form-group col-md-11'>
                                    <div>
                                        <input name='photo_url' value='{{ $user->name }}' src="{{ $personalCardsData->photo_url }}" id='photo_url' type='image' class="img-thumbnail mr-3" height="180" width="180">
                                    </div>
                                    <div class="media-body">
                                        <div class='form-row'>
                                            <div class="col-md-8">
                                                <label for='name' class="col-form-label col-form-label-sm">Пользователь</label>
                                                <input name='name' value='{{ $user->name }}' id='name' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Пользователь'>
                                            </div>
                                            <div class="col-md-4">
                                                <label for='second_name' class="col-form-label col-form-label-sm">Уровень доступа</label>
                                                @if ($user->access == 0)
                                                    @php $userAccess = "Администратор" @endphp
                                                @elseif ($user->access == 1)
                                                    @php $userAccess = "Руководитель" @endphp
                                                @elseif ($user->access == 2)
                                                    @php $userAccess = "Специалист" @endphp
                                                @elseif ($user->access == 3)
                                                    @php $userAccess = "Менеджер" @endphp
                                                @elseif ($user->access == 4)
                                                    @php $userAccess = "Работник" @endphp
                                                @endif
                                                <input name='second_name' value='{{ $userAccess }}' id='first_name' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Имя (первое имя)'>
                                            </div>
                                        </div>
                                        <div class='form-row'>
                                            <div class="col-md-3">
                                                <label for='personal_account' class="col-form-label col-form-label-sm">Табельный номер</label>
                                                <input name='personal_account' value='{{ $personalCardsData->personal_account }}' id='personal_account' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Табельный номер'>
                                            </div>
                                            <div class="col-md-5">
                                                <label for='full_name_latina' class="col-form-label col-form-label-sm">Фамилия и имя латиницей</label>
                                                <input name='full_name_latina' value='{{ $personalCardsData->full_name_latina }}' id='full_name_latina' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Фамилия и имя латиницей'>
                                            </div>
                                            <div class='col-md-1'>
                                                <label for='sex' class="col-form-label col-form-label-sm">Пол</label>
                                                <input name='sex' value='{{ $personalCardsData->sex }}' id='sex' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Пол'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='born_date' class="col-form-label col-form-label-sm">Дата рождения</label>
                                                <input name='born_date' value='{{ $personalCardsData->born_date }}' id='born_date' type='date' maxlength="50" readonly class="form-control form-control-sm" title='Дата рождения'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label for='phone' class="col-form-label col-form-label-sm">Телефон</label>
                                                <input name='phone' value='{{ $personalCardsData->phone }}' id='phone' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Телефон'>
                                            </div>
                                            <div class='col-md-6'>
                                                <label for='email' class="col-form-label col-form-label-sm">Email</label>
                                                <input name='email' value='{{ Auth::user()->email }}' id='email' type='email' readonly class="form-control form-control-sm" size="100" title='Email'>
                                            </div>
                                        </div>
                                        <div class="form-row">
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
                                        </div>
                                        <div class="form-row">
                                            <div class='col-md-9'>
                                                <label for='profession' class="col-form-label col-form-label-sm">Официальная должность</label>
                                                <input name='profession' value='{{ $manningOrderData->profession }}' id='profession' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Официальная должность'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='profession_code' class="col-form-label col-form-label-sm">Код профессии</label>
                                                <input name='profession_code' value='{{ $manningOrderData->profession_code }}' id='profession_code' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Код профессии'>
                                            </div>
                                        </div>
                                        <div class="form-row">
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
                                                    Мои назначения <span class="badge badge-secondary">{{ $manningOrderCount }}</span>
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
                                                            @foreach($manningOrderList as $manningOrderRow)
                                                            <tr>
                                                                <td>{{ $manningOrderRow->department }}</td>
                                                                <td>{{ $manningOrderRow->position }}</td>
                                                                <td>{{ $manningOrderRow->profession }}</td>
                                                                <td>{{ $manningOrderRow->profession_code }}</td>
                                                                <td>{{ $manningOrderRow->assignment_date }}</td>
                                                                <td>{{ $manningOrderRow->resignation_date }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <div class='col-md-12'>
                                                <a class="btn btn-outline-secondary btn-block" data-toggle="collapse" href="#collapseAllocations" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                                                    Мои перемещения <span class="badge badge-secondary">{{ $allocationCount }}</span>
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
                                                            @foreach($allocationList as $allocationRow)
                                                            <tr>
                                                                <td>{{ $allocationRow->object }}</td>
                                                                <td>{{ $allocationRow->team }}</td>
                                                                <td>{{ $allocationRow->start }}</td>
                                                                <td>{{ $allocationRow->expiry }}</td>
                                                            </tr>
                                                            @endforeach
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
