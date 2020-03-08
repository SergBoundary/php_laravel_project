@extends('layouts.app')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\PersonalCards 
         $user, $personalCardsData, $manningOrderData, $allocationData, 
         $manningOrderList, $allocationList, 
         $manningOrderCount, $allocationCount
         */
    @endphp
    <div id="interface-modul" modul="user-cabinet"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row col-md-12" style="margin-bottom: -10px">
                            <div class="mr-auto">
                                <h3 id="user-cabinet-title">{{ $interface['user-cabinet']['user-cabinet-title'] }}</h3>
                            </div>
                            <div class="ml-auto">
                                <div class="form-row">
                                    <div class='form-group col-md-auto'>
                                        <a class="btn btn-outline-secondary btn-sm" href="{{ url('/') }}"><img id="form-button-close" src="/img/visibility_off_black_18dp.png" alt="{{ $interface['form-button']['form-button-close'] }}" title="{{ $interface['form-button']['form-button-close'] }}"></a>
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
                                                <label id="user-cabinet-username" for='name' class="col-form-label col-form-label-sm">{{ $interface['user-cabinet']['user-cabinet-username'] }}</label>
                                                <input name='name' value='{{ $user->name }}' id='name' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Пользователь'>
                                            </div>
                                            <div class="col-md-4">
                                                <label id="user-access-level" for='user-access' class="col-form-label col-form-label-sm">{{ $interface['user-access-level']['user-access-level'] }}</label>
                                                @if ($user->access == 0)
                                                    <input id="user-access-level-administrator" name='user-access' value='{{ $interface['user-access-level']['user-access-level-administrator'] }}' id='user-access' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Уровень доступа'>
                                                @elseif ($user->access == 1)
                                                    <input id="user-access-level-director" name='user-access' value='{{ $interface['user-access-level']['user-access-level-director'] }}' id='user-access' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Уровень доступа'>
                                                @elseif ($user->access == 2)
                                                    <input id="user-access-level-specialist" name='user-access' value='{{ $interface['user-access-level']['user-access-level-specialist'] }}' id='user-access' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Уровень доступа'>
                                                @elseif ($user->access == 3)
                                                    <input id="user-access-level-team-leader" name='user-access' value='{{ $interface['user-access-level']['user-access-level-team-leader'] }}' id='user-access' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Уровень доступа'>
                                                @elseif ($user->access == 4)
                                                    <input id="user-access-level-employee" name='user-access' value='{{ $interface['user-access-level']['user-access-level-employee'] }}' id='user-access' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Уровень доступа'>
                                                @endif
                                            </div>
                                        </div>
                                        <div class='form-row'>
                                            <div class="col-md-3">
                                                <label id="user-cabinet-personnel-number" for='personal_account' class="col-form-label col-form-label-sm">{{ $interface['user-cabinet']['user-cabinet-personnel-number'] }}</label>
                                                <input name='personal_account' value='{{ $personalCardsData->personal_account }}' id='personal_account' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Табельный номер'>
                                            </div>
                                            <div class="col-md-5">
                                                <label id="user-cabinet-latin-letters" for='full_name_latina' class="col-form-label col-form-label-sm">{{ $interface['user-cabinet']['user-cabinet-latin-letters'] }}</label>
                                                <input name='full_name_latina' value='{{ $personalCardsData->full_name_latina }}' id='full_name_latina' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Фамилия и имя латиницей'>
                                            </div>
                                            <div class='col-md-1'>
                                                <label id="user-cabinet-sex" for='sex' class="col-form-label col-form-label-sm">{{ $interface['user-cabinet']['user-cabinet-sex'] }}</label>
                                                <input name='sex' value='{{ $personalCardsData->sex }}' id='sex' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Пол'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label id="user-cabinet-birth-date" for='born_date' class="col-form-label col-form-label-sm">{{ $interface['user-cabinet']['user-cabinet-birth-date'] }}</label>
                                                <input name='born_date' value='{{ $personalCardsData->born_date }}' id='born_date' type='date' maxlength="50" readonly class="form-control form-control-sm" title='Дата рождения'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label id="user-cabinet-leader-phone" for='phone' class="col-form-label col-form-label-sm">{{ $interface['user-cabinet']['user-cabinet-leader-phone'] }}</label>
                                                <input name='phone' value='{{ $personalCardsData->phone }}' id='phone' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Телефон'>
                                            </div>
                                            <div class='col-md-6'>
                                                <label id="user-cabinet-email" for='email' class="col-form-label col-form-label-sm">{{ $interface['user-cabinet']['user-cabinet-email'] }}</label>
                                                <input name='email' value='{{ Auth::user()->email }}' id='email' type='email' readonly class="form-control form-control-sm" size="100" title='Email'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class='col-md-6'>
                                                <label id="user-cabinet-position" for='position' class="col-form-label col-form-label-sm">{{ $interface['user-cabinet']['user-cabinet-position'] }}</label>
                                                <input name='position' value='{{ $manningOrderData->position }}' id='position' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Фактическая должность'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label id="user-cabinet-position-code" for='profession_code' class="col-form-label col-form-label-sm">{{ $interface['user-cabinet']['user-cabinet-position-code'] }}</label>
                                                <input name='profession_code' value='{{ $manningOrderData->profession_code }}' id='profession_code' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Код профессии'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label id="user-cabinet-appointment-date" for='assignment_date' class="col-form-label col-form-label-sm">{{ $interface['user-cabinet']['user-cabinet-appointment-date'] }}</label>
                                                <input name='assignment_date' value='{{ $manningOrderData->assignment_date }}' id='assignment_date' type='date' maxlength="50" readonly class="form-control form-control-sm" title='Дата назначения'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class='col-md-5'>
                                                <label id="user-cabinet-division" for='department' class="col-form-label col-form-label-sm">{{ $interface['user-cabinet']['user-cabinet-division'] }}</label>
                                                <input name='department' value='{{ $manningOrderData->department }}' id='department' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Департамент'>
                                            </div>
                                            <div class='col-md-7'>
                                                <label id="user-cabinet-team" for='team' class="col-form-label col-form-label-sm">{{ $interface['user-cabinet']['user-cabinet-team'] }}</label>
                                                <input name='team' value='{{ $allocationData->team }}' id='team' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Бригада'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class='col-md-9'>
                                                <label id="" for='user-cabinet-project' class="col-form-label col-form-label-sm">{{ $interface['user-cabinet']['user-cabinet-project'] }}</label>
                                                <input name='object' value='{{ $allocationData->object }}' id='object' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Объект'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label id="user-cabinet-allocation-date" for='start' class="col-form-label col-form-label-sm">{{ $interface['user-cabinet']['user-cabinet-allocation-date'] }}</label>
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
                                                    <span id="user-cabinet-appointments">{{ $interface['user-cabinet']['user-cabinet-appointments'] }}</span> <span class="badge badge-secondary">{{ $manningOrderCount }}</span>
                                                </a>
                                                <div class="collapse multi-collapse" id="collapseManningOrders">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <th id="user-cabinet-divisions" class="align-middle" scope="col">{{ $interface['user-cabinet']['user-cabinet-divisions'] }}</th>
                                                            <th id="user-cabinet-positions" class="align-middle" scope="col">{{ $interface['user-cabinet']['user-cabinet-positions'] }}</th>
                                                            <th id="user-cabinet-position-code" class="align-middle" scope="col">{{ $interface['user-cabinet']['user-cabinet-position-code'] }}</th>
                                                            <th id="user-cabinet-appointed" class="align-middle" scope="col">{{ $interface['user-cabinet']['user-cabinet-appointed'] }}</th>
                                                            <th id="user-cabinet-dismissed" class="align-middle" scope="col">{{ $interface['user-cabinet']['user-cabinet-dismissed'] }}</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($manningOrderList as $manningOrderRow)
                                                            <tr>
                                                                <td>{{ $manningOrderRow->department }}</td>
                                                                <td>{{ $manningOrderRow->position }}</td>
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
                                                    <span id="user-cabinet-allocations">{{ $interface['user-cabinet']['user-cabinet-allocations'] }}</span> <span class="badge badge-secondary">{{ $allocationCount }}</span>
                                                </a>
                                                <div class="collapse multi-collapse" id="collapseAllocations">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <th id="user-cabinet-projects" class="align-middle" scope="col">{{ $interface['user-cabinet']['user-cabinet-projects'] }}</th>
                                                            <th id="user-cabinet-teams" class="align-middle" scope="col">{{ $interface['user-cabinet']['user-cabinet-teams'] }}</th>
                                                            <th id="user-cabinet-included" class="align-middle" scope="col">{{ $interface['user-cabinet']['user-cabinet-included'] }}</th>
                                                            <th id="user-cabinet-excluded" class="align-middle" scope="col">{{ $interface['user-cabinet']['user-cabinet-excluded'] }}</th>
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
